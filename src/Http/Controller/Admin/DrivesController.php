<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Drive\Form\DriveConfigurationFormBuilder;
use Anomaly\FilesModule\Drive\Form\DriveFormBuilder;
use Anomaly\FilesModule\Drive\Table\DriveTableBuilder;
use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;
use Anomaly\Streams\Platform\Addon\AddonCollection;
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

    /**
     * Return a form to create a new drive.
     *
     * @param DriveFormBuilder $form
     * @param null             $adapter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DriveFormBuilder $form, $adapter = null)
    {
        return $form->setOption('adapter', $adapter)->render();
    }

    /**
     * Return a form to edit an existing drive.
     *
     * @param DriveFormBuilder $form
     * @param                  $id
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        DriveConfigurationFormBuilder $form,
        DriveFormBuilder $drive,
        SettingFormBuilder $settings,
        $id
    ) {
        $form->addForm('drive', $drive);
        $form->addForm('settings', $settings->setEntry('anomaly.extension.local_storage_adapter'));

        $settings->setEntry('anomaly.extension.local_storage_adapter')->build();

        return $form->render($id);
    }
}
