<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
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
     * Choose a storage adapter for this drive.
     *
     * @param ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions)
    {
        $adapters = $extensions->search('anomaly.module.files::storage_adapter.*');

        return view('module::admin/storage_adapters/choose', compact('adapters'));
    }
}
