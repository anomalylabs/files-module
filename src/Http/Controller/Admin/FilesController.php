<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\Form\FileFormBuilder;
use Anomaly\FilesModule\File\Table\FileTableBuilder;
use Anomaly\FilesModule\File\Upload\UploadFormBuilder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

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
     * Edit an existing entry.
     *
     * @param FileFormBuilder $form
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FileFormBuilder $form, $id)
    {
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

        return $this->redirect->to('files/' . $file->getFolder()->getSlug() . '/' . $file->getFilename());
    }

    /**
     * Return the form to upload files.
     *
     * @param FolderRepositoryInterface $folders
     * @param UploadFormBuilder         $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function upload(FolderRepositoryInterface $folders, UploadFormBuilder $form)
    {
        $form->setFolder($folders->findBySlug($this->request->get('folder')));

        return $form->render();
    }
}
