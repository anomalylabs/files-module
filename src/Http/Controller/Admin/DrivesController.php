<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Drive\Ui\Table\DriveTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class DrivesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\DrivesModule\Http\Controller\Admin
 */
class DrivesController extends AdminController
{

    /**
     * Return an index of existing drives.
     *
     * @param DriveTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(DriveTableBuilder $table)
    {
        return $table->render();
    }
}
