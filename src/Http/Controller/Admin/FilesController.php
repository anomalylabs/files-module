<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Table\FileTableBuilder;
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
     * Return an index of existing files and folders.
     *
     * @param FileTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(FileTableBuilder $table)
    {
        return $table->render();
    }
}
