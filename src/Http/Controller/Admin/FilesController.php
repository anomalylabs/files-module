<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\Form\EntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileEntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileFormBuilder;
use Anomaly\FilesModule\File\Table\FileTableBuilder;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
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
     * @param  FileTableBuilder $table
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
     * @param  FileRepositoryInterface $files
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(FileRepositoryInterface $files)
    {
        /* @var FileInterface $file */
        if (!$file = $files->find($this->route->getParameter('id'))) {
            abort(404);
        }

        return $this->redirect->to($file->route('view'));
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
    
    /**
     * Get image from external source
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function external(
        FileRepositoryInterface $files,
        FolderRepositoryInterface $folders
    )
    {
        $req = $this->request->all();
        $url = array_get($req, 'url');

        $filename = array_get(array_reverse(explode('/', $url)), 0);

        $cb = curl_init();
        curl_setopt($cb, CURLOPT_URL, $url);
        curl_setopt($cb, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cb, CURLOPT_BINARYTRANSFER, true);

        curl_exec($cb);
        $mime   = curl_getinfo($cb, CURLINFO_CONTENT_TYPE);

        if (!preg_match('/^image\/\w+/', $mime))
        {
            return $this->response->json([
                'success' => false,
                'message' => 'Not an image!',
            ]);
        }

        /* @var FolderInterface|null $folder */
        $folder = $this->dispatch(
            new GetFolder(array_get($req, 'folder', 1))
        );

        return $this->response->json(array_merge(
            compact('folder', 'filename', 'url', 'mime'),
            ['success' => true]
        ));
    }
}
