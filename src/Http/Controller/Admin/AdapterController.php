<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AdapterController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class AdapterController extends AdminController
{

    /**
     * Return a list of drive extensions to choose from.
     *
     * @param ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions)
    {
        $extensions = $extensions->search('anomaly.module.files::adapter.*');

        return view('module::admin/adapter/choose', compact('extensions'));
    }
}
