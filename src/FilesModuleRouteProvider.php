<?php namespace Anomaly\FilesModule;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class FilesModuleRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModuleRouteProvider extends RouteServiceProvider
{

    /**
     * Map the routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Adapter routes.
        $router->get(
            'admin/files/storage_adapters/choose',
            'Anomaly\FilesModule\Http\Controller\Admin\StorageAdaptersController@choose'
        );

        // Browser routes.
        $router->any(
            'admin/files',
            'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@redirect'
        );

        $router->any(
            'admin/files/browser',
            'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index'
        );

        // Driver routes.
        $router->any(
            'admin/files/drives',
            'Anomaly\FilesModule\Http\Controller\Admin\DrivesController@index'
        );

        $router->any(
            'admin/files/drives/create/{adapter}',
            'Anomaly\FilesModule\Http\Controller\Admin\DrivesController@create'
        );

        // Folder routes.
        $router->any(
            'admin/files/folders',
            'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@redirect'
        );

        $router->any(
            'admin/files/folders/create',
            'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@create'
        );
    }
}
