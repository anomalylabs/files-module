<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\File\Upload\UploadTableBuilder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Contracts\Config\Repository;

/**
 * Class UploadController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class UploadController extends AdminController
{

    /**
     * Return the form to upload files.
     *
     * @param FolderRepositoryInterface $folders
     * @param UploadTableBuilder        $table
     * @param                           $folder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FolderRepositoryInterface $folders, UploadTableBuilder $table, $folder)
    {
        $folder = $folders->findBySlug($folder);

        $table->make();

        $table = $table->getTable();

        return $this->view->make('module::admin/upload/index', compact('folder', 'table'));
    }

    /**
     * Handle the upload.
     *
     * @param FileUploader              $uploader
     * @param FolderRepositoryInterface $folders
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(FileUploader $uploader, FolderRepositoryInterface $folders)
    {
        if ($file = $uploader->upload($this->request->file('upload'), $folders->find($this->request->get('folder')))) {
            return $this->response->json($file->getAttributes());
        }

        return $this->response->json(['error' => 'There was a problem uploading the file.'], 500);
    }

    /**
     * Return table of uploaded files.
     *
     * @param UploadTableBuilder $builder
     * @return null|string
     */
    public function recent(UploadTableBuilder $builder)
    {
        return $builder
            ->setUploaded(explode(',', $this->request->get('uploaded')))
            ->make()
            ->getTableContent();
    }
}
