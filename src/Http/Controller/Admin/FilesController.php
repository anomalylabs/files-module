<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\Form\EntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileEntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileFormBuilder;
use Anomaly\FilesModule\File\Table\FileTableBuilder;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

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
     * @param      FileTableBuilder  $table
     * @return     Response
     */
    public function index(FileTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return an ajax modal to choose the folder to use for uploading files.
     *
     * @param      FolderRepositoryInterface  $folders
     * @return     Response
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
     * @param      FileRepositoryInterface  $files
     * @param      FileFormBuilder          $fileForm
     * @param      EntryFormBuilder         $entryForm
     * @param      FileEntryFormBuilder     $form
     * @param      string                   $id
     *
     * @return     Response
     */
    public function edit(
        FileRepositoryInterface $files,
        FileFormBuilder $fileForm,
        EntryFormBuilder $entryForm,
        FileEntryFormBuilder $form,
        $id
    ) {
        /* @var FileInterface $file */
        if (!$file = $files->find($id)) {
            abort(404);
        }

        $form->addForm(
            'entry',
            $entryForm
                ->setFormMode('edit')
                ->setModel($file->getFolder()->getEntryModelName())
                ->setEntry($file->getEntry())
        );

        $form->addForm('file', $fileForm->setEntry($file));

        return $form->render($id);
    }

    /**
     * Redirect to a file's URL.
     *
     * @param      FileRepositoryInterface  $files
     * @return     Response
     */
    public function view(FileRepositoryInterface $files, $id)
    {
        /* @var FileInterface $file */
        if (!$file = $files->find($id)) {
            abort(404);
        }

        return $this->redirect->to($file->route('view'));
    }

    /**
     * Return if a file exists or not.
     *
     * @param      FileRepositoryInterface  $files
     * @param      string                   $folder
     * @param      string                   $name
     * @return     Response
     */
    public function exists(FileRepositoryInterface $files, $folder, $name)
    {
        /* @var FolderInterface|null $folder */
        if ($folder = $this->dispatch(new GetFolder((int) $folder))) {

            /* @var FileInterface|null $file */
            if ($file = $files->findByNameAndFolder($name, $folder)) {

                return $this->response->json([
                    'exists'  => true,
                    'success' => true
                ]);
            }
        }

        return $this->response->json([
            'exists'  => false,
            'success' => true
        ]);
    }
}
