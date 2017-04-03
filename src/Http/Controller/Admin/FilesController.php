<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileStreamer;
use Anomaly\FilesModule\File\Form\EntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileEntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileFormBuilder;
use Anomaly\FilesModule\File\Table\FileTableBuilder;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Contracts\Config\Repository;

/**
 * Class FilesController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FilesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param  FileTableBuilder                           $table
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
        return $this->view->make(
            'module::ajax/choose_folder',
            [
                'folders' => $folders->all(),
            ]
        );
    }

    /**
     * Return the form for editing an existing file.
     *
     * @param  FileRepositoryInterface                    $files
     * @param  FileEntryFormBuilder                       $form
     * @param                                             $id
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
            $entryForm
                ->setFormMode('edit')
                ->setModel($file->getFolder()->getEntryModelName())->setEntry($file->getEntry())
        );

        $form->addForm('file', $fileForm->setEntry($file));

        return $form->render($id);
    }

    /**
     * Redirect to a file's URL.
     *
     * @param  FileRepositoryInterface           $files
     * @param  FileStreamer                      $streamer
     * @param                                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(FileRepositoryInterface $files, FileStreamer $streamer, $id)
    {
        /* @var FileInterface $file */
        if (!$file = $files->find($id)) {
            abort(404);
        }

        return $streamer->stream($file);
    }

    /**
     * Return if a file exists or not.
     *
     * @param  FileRepositoryInterface       $files
     * @param                                $folder
     * @param                                $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function exists(FileRepositoryInterface $files, $folder, $name)
    {
        $success = true;
        $exists  = false;

        /* @var FolderInterface|null $folder */
        $folder = $this->dispatch(new GetFolder($folder));

        if ($folder && $file = $files->findByNameAndFolder($name, $folder)) {
            $exists = true;
        }

        return $this->response->json(compact('success', 'exists'));
    }
}
