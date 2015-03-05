<?php namespace Anomaly\FilesModule\Browser;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class BrowserRouterProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser
 */
class BrowserRouterProvider extends RouteServiceProvider
{

    /**
     * Map the routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->any(
            'admin/files',
            'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index'
        );
    }
}
