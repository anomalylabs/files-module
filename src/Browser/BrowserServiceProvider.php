<?php namespace Anomaly\FilesModule\Browser;

use Illuminate\Support\ServiceProvider;

/**
 * Class BrowserServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser
 */
class BrowserServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Anomaly\FilesModule\Browser\BrowserRouterProvider');
    }
}
