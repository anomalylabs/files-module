<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\Form\EntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileEntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileFormBuilder;
use Anomaly\FilesModule\File\Table\FileTableBuilder;
use Anomaly\FilesModule\File\Table\UploadedTableBuilder;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Contracts\Config\Repository;
use League\Flysystem\MountManager;

/**
 * Class FilesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class FilesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param FileTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FileTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return an ajax modal to choose the folder
     * to use for uploading files.
     *
     * @param FolderRepositoryInterface
     * @return \Illuminate\View\View
     */
    public function choose(FolderRepositoryInterface $folders)
    {
        return view(
            'module::ajax/choose_folder',
            [
                'folders' => $folders->all()
            ]
        );
    }

    /**
     * Create a new entry.
     *
     * @param FileFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FileFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return the form for editing an existing file.
     *
     * @param FileRepositoryInterface $files
     * @param FileEntryFormBuilder    $form
     * @param                         $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        FileRepositoryInterface $files,
        FileFormBuilder $fileForm,
        EntryFormBuilder $entryForm,
        FileEntryFormBuilder $form,
        $id
    ) {
        /* @var FileInterface $file */
        $file = $files->find($id);

        $form->addForm(
            'entry',
            $entryForm->setModel($file->getFolder()->getEntryModelName())->setEntry($file->getEntry())
        );
        $form->addForm('file', $fileForm->setEntry($file));

        return $form->render($id);
    }

    /**
     * Redirect to a file's URL.
     *
     * @param FileRepositoryInterface $files
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(FileRepositoryInterface $files, $id)
    {
        /* @var FileInterface $file */
        $file = $files->find($id);

        return $this->redirect->to('files/' . $file->getFolder()->getSlug() . '/' . $file->getName());
    }

    /**
     * Return the form to upload files.
     *
     * @param FolderRepositoryInterface $folders
     * @param                           $folder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function upload(FolderRepositoryInterface $folders, UploadedTableBuilder $table, $folder)
    {
        $folder = $folders->findBySlug($folder);

        $table->make();

        $table = $table->getTable();

        return $this->view->make('module::admin/upload', compact('folder', 'table'));
    }

    /**
     * Handle the upload.
     *
     * @param MountManager              $manager
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     * @param Repository                $config
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(
        MountManager $manager,
        FileRepositoryInterface $files,
        FolderRepositoryInterface $folders,
        Repository $config
    ) {
        /* @var FolderInterface $folder */
        $folder = $folders->find($this->request->get('folder'));

        /* @var DiskInterface $disk */
        $disk = $folder->getDisk();

        $file = $this->request->file('upload');

        $matches = array_filter(
            $types = $folder->getAllowedTypes(),
            function ($type) use ($file) {

                if ($type == '.' . $file->getClientOriginalExtension()) {
                    return true;
                }

                if (str_is($type, $file->getMimeType())) {
                    return true;
                }

                return false;
            }
        );

        if ($types && !$matches) {
            return $this->response->json(['error' => 'The file type is not allowed.'], 500);
        }

        /* @var FileInterface $entry */
        $entry = $manager->putStream(
            $disk->getSlug() . '://' . $folder->getSlug() . '/' . $file->getClientOriginalName(),
            fopen($file->getRealPath(), 'r+')
        );

        if (in_array($entry->getExtension(), $config->get('anomaly.module.files::mimes.types.image'))) {

            $size = getimagesize($file->getRealPath());

            $files->save($entry->fill(['width' => $size[0], 'height' => $size[1]]));
        }

        return $this->response->json($entry->getAttributes());
    }
}
