<?php namespace Anomaly\FilesModule\Adapter;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class AdapterRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter
 */
class AdapterRouteProvider extends RouteServiceProvider
{

    /**
     * Map adapter routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->get(
            'admin/files/adapter/choose',
            'Anomaly\FilesModule\Http\Controller\Admin\AdapterController@choose'
        );
    }
}
