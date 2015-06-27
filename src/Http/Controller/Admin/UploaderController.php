<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\FilesModule\Uploader\Form\UploaderFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class UploaderController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class UploaderController extends AdminController
{

    /**
     * Return the upload form.
     *
     * @param UploaderFormBuilder $uploader
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploader(
        UploaderFormBuilder $uploader,
        FolderRepositoryInterface $folders,
        DiskRepositoryInterface $disks,
        $disk,
        $path = null
    ) {
        $uploader->setDisk($disk = $disks->findBySlug($disk));

        if ($folder = $folders->findByPath($path, $disk)) {
            $uploader->setFolder($folder);
        }

        return $uploader->render();
    }
}
