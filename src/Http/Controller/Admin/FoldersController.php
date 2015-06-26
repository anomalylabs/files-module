<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\FilesModule\Folder\Form\FolderFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class FoldersController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class FoldersController extends AdminController
{

    /**
     * Return a form to create a new folder.
     *
     * @param FolderFormBuilder $form
     * @param                   $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        FolderFormBuilder $form,
        DiskRepositoryInterface $disks,
        FolderRepositoryInterface $folders,
        $disk,
        $path = null
    ) {
        $form->setDisk($disk = $disks->findBySlug($disk));

        if ($path && $parent = $folders->findByPath($path, $disk)) {
            $form->setParent($parent);
        }

        return $form->render();
    }
}
