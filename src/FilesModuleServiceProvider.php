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
     * The plugins.
     *
     * @var array
     */
    protected $plugins = [
        'Anomaly\FilesModule\File\Plugin\FilePlugin'
    ];

    /**
     * The event listeners.
     *
     * @var array
     */
    protected $listeners = [
        'Anomaly\Streams\Platform\Addon\Event\AddonsHaveRegistered' => [
            'Anomaly\FilesModule\Disk\Listener\RegisterDisks'
        ]
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\FilesModule\File\Contract\FileRepositoryInterface'           => 'Anomaly\FilesModule\File\FileRepository',
        'Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface'           => 'Anomaly\FilesModule\Disk\DiskRepository',
        'Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface'       => 'Anomaly\FilesModule\Folder\FolderRepository',
        'Anomaly\FilesModule\Container\Contract\ContainerRepositoryInterface' => 'Anomaly\FilesModule\Container\ContainerRepository'
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/files'                        => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@index',
        'admin/files/choose'                 => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@choose',
        'admin/files/upload'                 => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@upload',
        'admin/files/edit/{id}'              => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@edit',
        'admin/files/view/{id}'              => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@view',
        'admin/files/folders'                => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@index',
        'admin/files/folders/create'         => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@create',
        'admin/files/folders/edit/{id}'      => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@edit',
        'admin/files/disks'                  => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@index',
        'admin/files/disks/choose'           => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@choose',
        'admin/files/disks/create'           => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@create',
        'admin/files/disks/edit/{id}'        => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@edit',
        'admin/files/upload/{disk}/{path?}'  => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@upload',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/{folder}/{filename}'          => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@read',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/thumb/{folder}/{filename}'    => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@thumb',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/stream/{folder}/{filename}'   => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@stream',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/download/{folder}/{filename}' => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@download',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ]
    ];

}
