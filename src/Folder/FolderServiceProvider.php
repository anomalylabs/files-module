<?php namespace Anomaly\FilesModule\Folder;

use Illuminate\Support\ServiceProvider;

/**
 * Class FolderServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder
 */
class FolderServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Anomaly\FilesModule\Folder\FolderModel',
            'Anomaly\FilesModule\Folder\FolderModel'
        );

        $this->app->bind(
            'Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface',
            'Anomaly\FilesModule\Folder\FolderRepository'
        );

        $this->app->register('Anomaly\FilesModule\Folder\FolderRouteProvider');
    }
}
