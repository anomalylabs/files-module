<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Form\DiskConfigurationFormBuilder;
use Anomaly\FilesModule\Disk\Form\DiskFormBuilder;
use Anomaly\FilesModule\Disk\Table\DiskTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class DisksController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\DisksModule\Http\Controller\Admin
 */
class DisksController extends AdminController
{

    /**
     * Return an index of existing disks.
     *
     * @param DiskTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(DiskTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a form to create a new disk.
     *
     * @param DiskFormBuilder     $form
     * @param ExtensionCollection $adapters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DiskFormBuilder $form, ExtensionCollection $adapters)
    {
        return $form->setAdapter($adapters->get($_GET['adapter']))->render();
    }

    /**
     * Return a form to edit an existing disk.
     *
     * @param DiskFormBuilder $form
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(DiskFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
