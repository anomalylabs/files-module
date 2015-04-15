<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Adapter\Table\StorageAdapterTableBuilder;
use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class StorageAdaptersController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class StorageAdaptersController extends AdminController
{

    /**
     * Return an index of existing storage adapters.
     *
     * @param StorageAdapterTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(StorageAdapterTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a form for adapter settings.
     *
     * @param SettingFormBuilder $settings
     * @param                    $adapter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function settings(SettingFormBuilder $settings, $adapter)
    {
        return $settings->render($adapter);
    }
}
