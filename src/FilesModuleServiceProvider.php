<?php namespace Anomaly\FilesModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class FilesModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule
 */
class FilesModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The commands.
     *
     * @var array
     */
    protected $commands = [
        'Anomaly\FilesModule\Console\Clean'
    ];

    /**
     * The plugins.
     *
     * @var array
     */
    protected $plugins = [
        'Anomaly\FilesModule\FilesModulePlugin'
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
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\Streams\Platform\Model\Files\FilesFilesEntryModel'   => 'Anomaly\FilesModule\File\FileModel',
        'Anomaly\Streams\Platform\Model\Files\FilesFoldersEntryModel' => 'Anomaly\FilesModule\Folder\FolderModel'
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
        'admin/files'                                                  => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@index',
        'admin/files/choose'                                           => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@choose',
        'admin/files/upload/handle'                                    => 'Anomaly\FilesModule\Http\Controller\Admin\UploadController@upload',
        'admin/files/upload/recent'                                    => 'Anomaly\FilesModule\Http\Controller\Admin\UploadController@recent',
        'admin/files/upload/{folder}'                                  => 'Anomaly\FilesModule\Http\Controller\Admin\UploadController@index',
        'admin/files/edit/{id}'                                        => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@edit',
        'admin/files/view/{id}'                                        => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@view',
        'admin/files/folders'                                          => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@index',
        'admin/files/folders/create'                                   => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@create',
        'admin/files/folders/edit/{id}'                                => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@edit',
        'admin/files/folders/assignments/{id}'                         => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@fields',
        'admin/files/folders/choose/{id}'                              => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@choose',
        'admin/files/folders/assignments/{id}/assign/{field}'          => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@assign',
        'admin/files/folders/assignments/{id}/assignment/{assignment}' => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@assignment',
        'admin/files/disks'                                            => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@index',
        'admin/files/disks/choose'                                     => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@choose',
        'admin/files/disks/create'                                     => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@create',
        'admin/files/disks/edit/{id}'                                  => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@edit',
        'admin/files/fields'                                           => 'Anomaly\FilesModule\Http\Controller\Admin\FieldsController@index',
        'admin/files/fields/choose'                                    => 'Anomaly\FilesModule\Http\Controller\Admin\FieldsController@choose',
        'admin/files/fields/create'                                    => 'Anomaly\FilesModule\Http\Controller\Admin\FieldsController@create',
        'admin/files/fields/edit/{id}'                                 => 'Anomaly\FilesModule\Http\Controller\Admin\FieldsController@edit',
        'admin/files/upload/{disk}/{path?}'                            => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@upload',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/{folder}/{name}'                                        => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@read',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/thumb/{folder}/{name}'                                  => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@thumb',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/stream/{folder}/{name}'                                 => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@stream',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/download/{folder}/{name}'                               => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@download',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ]
    ];

}
