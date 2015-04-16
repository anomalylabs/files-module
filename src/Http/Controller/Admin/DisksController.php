<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Disk\Form\DiskConfigurationFormBuilder;
use Anomaly\FilesModule\Disk\Form\DiskFormBuilder;
use Anomaly\FilesModule\Disk\Table\DiskTableBuilder;
use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;
use Anomaly\Streams\Platform\Addon\AddonCollection;
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
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(DiskTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a form to create a new disk.
     *
     * @param DiskFormBuilder $form
     * @param null             $adapter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DiskFormBuilder $form, $adapter = null)
    {
        return $form->setOption('adapter', $adapter)->render();
    }

    /**
     * Return a form to edit an existing disk.
     *
     * @param DiskFormBuilder $form
     * @param                  $id
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        DiskConfigurationFormBuilder $form,
        DiskFormBuilder $disk,
        SettingFormBuilder $settings,
        $id
    ) {
        $form->addForm('disk', $disk);
        $form->addForm('settings', $settings->setEntry('anomaly.extension.local_storage_adapter'));

        $disk->setEntry($id);
        $settings->setEntry('anomaly.extension.local_storage_adapter')->build();

        return $form->render($id);
    }
}
