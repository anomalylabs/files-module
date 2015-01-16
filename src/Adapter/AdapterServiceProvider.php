<?php namespace Anomaly\FilesModule\Adapter;

use Illuminate\Support\ServiceProvider;

/**
 * Class AdapterServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter
 */
class AdapterServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Anomaly\FilesModule\Adapter\AdapterRouteProvider');
    }
}
