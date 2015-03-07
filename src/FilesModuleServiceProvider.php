<?php namespace Anomaly\FilesModule;

use Illuminate\Support\ServiceProvider;

/**
 * Class FilesModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModuleServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Anomaly\FilesModule\File\FileServiceProvider');
        $this->app->register('Anomaly\FilesModule\Drive\DriveServiceProvider');
        $this->app->register('Anomaly\FilesModule\Folder\FolderServiceProvider');
        $this->app->register('Anomaly\FilesModule\Browser\BrowserServiceProvider');
        $this->app->register('Anomaly\FilesModule\Adapter\StorageAdapterServiceProvider');
    }
}
