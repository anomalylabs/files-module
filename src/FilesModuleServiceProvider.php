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
        // Drive services.
        $this->app->bind(
            'Anomaly\FilesModule\Drive\DriveModel',
            'Anomaly\FilesModule\Drive\DriveModel'
        );

        $this->app->bind(
            'Anomaly\FilesModule\Drive\Contract\DriveRepositoryInterface',
            'Anomaly\FilesModule\Drive\DriveRepository'
        );

        // File services.
        $this->app->bind(
            'Anomaly\FilesModule\File\FileModel',
            'Anomaly\FilesModule\File\FileModel'
        );
        $this->app->bind(
            'Anomaly\FilesModule\File\Contract\FileRepositoryInterface',
            'Anomaly\FilesModule\File\FileRepository'
        );

        // Folder services.
        $this->app->bind(
            'Anomaly\FilesModule\Folder\FolderModel',
            'Anomaly\FilesModule\Folder\FolderModel'
        );

        $this->app->bind(
            'Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface',
            'Anomaly\FilesModule\Folder\FolderRepository'
        );

        // Module routes.
        $this->app->register('Anomaly\FilesModule\FilesModuleRouteProvider');
    }
}
