<?php namespace Anomaly\FilesModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

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
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/files'                               => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@redirect',
        'admin/files/browser/{disk?}/{path?}'       => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'admin/files/view/{disk}/{path}'            => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@view',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'admin/files/disks'                         => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@index',
        'admin/files/disks/create'                  => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@create',
        'admin/files/disks/edit/{id}'               => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@edit',
        'admin/files/ajax/choose_adapter'           => 'Anomaly\FilesModule\Http\Controller\Admin\AjaxController@chooseAdapter',
        'admin/files/settings'                      => 'Anomaly\FilesModule\Http\Controller\Admin\SettingsController@edit',
        'admin/files/uploader'                      => 'Anomaly\FilesModule\Http\Controller\Admin\UploaderController@uploader',
        'admin/files/folders/create/{disk}/{path?}' => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@create',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/uploader'                            => 'Anomaly\FilesModule\Http\Controller\UploadController@uploader',
        'files/upload'                              => 'Anomaly\FilesModule\Http\Controller\UploadController@upload'
    ];

    /**
     * Addon route constraints.
     *
     * @var array
     */
    protected $constraints = [
        'admin/files/browser/{disk?}/{path?}',
        'admin/files/view/{disk}/{path}',
        'admin/files/folder/create/{disk}/{path}',
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\FilesModule\Disk\DiskModel'     => 'Anomaly\FilesModule\Disk\DiskModel',
        'Anomaly\FilesModule\Folder\FolderModel' => 'Anomaly\FilesModule\Folder\FolderModel',
        'Anomaly\FilesModule\File\FileModel'     => 'Anomaly\FilesModule\File\FileModel'
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface'     => 'Anomaly\FilesModule\Disk\DiskRepository',
        'Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface' => 'Anomaly\FilesModule\Folder\FolderRepository',
        'Anomaly\FilesModule\File\Contract\FileRepositoryInterface'     => 'Anomaly\FilesModule\File\FileRepository'
    ];

    /**
     * The event listeners.
     *
     * @var array
     */
    protected $listeners = [
        'Anomaly\Streams\Platform\Application\Event\ApplicationHasLoaded' => [
            'Anomaly\FilesModule\Disk\Listener\ExtendFilesystem'
        ]
    ];

}
