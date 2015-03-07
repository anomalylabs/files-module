<?php namespace Anomaly\FilesModule\Adapter;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class StorageAdapterRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class StorageAdapterRouteProvider extends RouteServiceProvider
{

    /**
     * Map the routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->get(
            'admin/files/storage_adapters/choose',
            'Anomaly\FilesModule\Http\Controller\Admin\StorageAdaptersController@choose'
        );
    }
}
