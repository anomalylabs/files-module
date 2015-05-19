<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AjaxController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class AjaxController extends AdminController
{

    public function chooseAdapter(ExtensionCollection $extensions)
    {
        return view(
            'module::admin/ajax/choose_adapter',
            ['adapters' => $extensions->search('anomaly.module.files::storage_adapter.*')]
        );
    }
}
