<?php namespace Anomaly\FilesModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class FilesModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\FilesModule\Drive\DriveModel'   => 'Anomaly\FilesModule\Drive\DriveModel',
        'Anomaly\FilesModule\File\FileModel'     => 'Anomaly\FilesModule\File\FileModel',
        'Anomaly\FilesModule\Folder\FolderModel' => 'Anomaly\FilesModule\Folder\FolderModel'
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\FilesModule\Drive\Contract\DriveRepositoryInterface'   => 'Anomaly\FilesModule\Drive\DriveRepository',
        'Anomaly\FilesModule\File\Contract\FileRepositoryInterface'     => 'Anomaly\FilesModule\File\FileRepository',
        'Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface' => 'Anomaly\FilesModule\Folder\FolderRepository'
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/files'                       => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@redirect',
        'admin/files/browser'               => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index',
        'admin/files/drives'                => 'Anomaly\FilesModule\Http\Controller\Admin\DrivesController@index',
        'admin/files/drives/create/{type?}' => 'Anomaly\FilesModule\Http\Controller\Admin\DrivesController@create',
        'admin/files/drives/edit/{id}'      => 'Anomaly\FilesModule\Http\Controller\Admin\DrivesController@edit',
        'admin/files/folders'               => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@redirect',
        'admin/files/folders/create'        => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@create',
        'admin/files/settings'              => 'Anomaly\FilesModule\Http\Controller\Admin\SettingsController@edit'
    ];

    /**
     * Map additional routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router
            ->any(
                'admin/files/browser/{drive?}/{path?}',
                'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index'
            )
            ->where('drive', '^[a-z0-9_]+$')
            ->where('path', '(.*)');
    }
}
