<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Entry\Form\EntryFormBuilder;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\Form\FileEntryFormBuilder;
use Anomaly\FilesModule\File\Form\FileFormBuilder;
use Anomaly\FilesModule\File\Upload\UploadFormBuilder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Symfony\Component\HttpFoundation\Response;

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
     * Return the form to upload files.
     *
     * @param FolderRepositoryInterface $folders
     * @param DiskRepositoryInterface   $disks
     * @param UploadFormBuilder         $form
     * @param                           $disk
     * @param null                      $path
     * @return Response
     */
    public function upload(
        FolderRepositoryInterface $folders,
        DiskRepositoryInterface $disks,
        UploadFormBuilder $form,
        $disk,
        $path = null
    ) {
        $form->setDisk($disk = $disks->findBySlug($disk));

        if ($path && $folder = $folders->findByPath($path, $disk)) {
            $form->setFolder($folder);
        }

        return $form->render();
    }

    public function edit(
        FileEntryFormBuilder $form,
        FileRepositoryInterface $files,
        EntryFormBuilder $entryForm,
        FileFormBuilder $fileForm,
        $id
    ) {
        $file   = $files->find($id);
        $disk   = $file->getDisk();
        $stream = $disk->getEntriesStream();

        $entryForm
            ->setModel($stream->getEntryModel())
            ->setEntry($file->getEntryId());

        $fileForm->setEntry($id);

        $form
            ->addForm('entry', $entryForm)
            ->addForm('file', $fileForm);

        $form->setOption('redirect', dirname('admin/files/browser/' . $disk->browserPath($files->find($id)->path())));

        return $form->render($id);
    }

    public function test(DiskRepositoryInterface $disks)
    {
        return view(
            'module::admin/test',
            [
                'disks' => $disks->all()
            ]
        );
    }
}
