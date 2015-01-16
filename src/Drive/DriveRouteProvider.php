<?php namespace Anomaly\FilesModule\Drive;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class DriveRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive
 */
class DriveRouteProvider extends RouteServiceProvider
{

    /**
     * Map drives routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->any(
            'admin/files/drives',
            'Anomaly\FilesModule\Http\Controller\Admin\DrivesController@index'
        );
        $router->any(
            'admin/files/drives/create/{adapter}',
            'Anomaly\FilesModule\Http\Controller\Admin\DrivesController@create'
        );
    }
}
