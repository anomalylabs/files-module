<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Object\Contract\ObjectRepositoryInterface;
use Anomaly\FilesModule\Object\Grid\ObjectGridBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ObjectsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class ObjectsController extends AdminController
{

    /**
     * Return an index of objects.
     *
     * @param ObjectGridBuilder       $grid
     * @param DiskRepositoryInterface $disks
     * @param                         $disk
     * @return \Illuminate\Http\Response
     */
    public function index(
        ObjectGridBuilder $grid,
        DiskRepositoryInterface $disks,
        ObjectRepositoryInterface $objects,
        $disk,
        $path = null
    ) {
        return $grid
            ->setDisk($disks->findBySlug($disk))
            ->setParent($objects->findByPath($path))
            ->render();
    }
}
