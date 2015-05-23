<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Grid\DiskGridBuilder;
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
     * Return an index of of existing disks.
     *
     * @param DiskGridBuilder $grid
     * @return \Illuminate\Http\Response
     */
    public function index(DiskGridBuilder $grid)
    {
        return $grid->render();
    }
}
