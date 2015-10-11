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
        'Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface'     => 'Anomaly\FilesModule\Disk\DiskRepository',
        'Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface' => 'Anomaly\FilesModule\Folder\FolderRepository',
        'Anomaly\FilesModule\File\Contract\FileRepositoryInterface'     => 'Anomaly\FilesModule\File\FileRepository'
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'files/get/{disk}/{path}'                              => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@read',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/thumb/{disk}/{path}'                            => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@thumb',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/stream/{disk}/{path}'                           => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@stream',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'files/download/{disk}/{path}'                         => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@download',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'admin/files'                                          => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index',
        'admin/files/browser/{disk?}/{path?}'                  => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'admin/files/view/{disk}/{path}'                       => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@view',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'admin/files/folders/create/{disk}/{path?}'            => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@create',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'admin/files/upload/{disk}/{path?}'                    => [
            'uses'        => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@upload',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)'
            ]
        ],
        'admin/files/edit/{id}'                                => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@edit',
        'admin/files/disks'                                    => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@index',
        'admin/files/disks/choose'                             => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@choose',
        'admin/files/disks/create'                             => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@create',
        'admin/files/disks/edit/{id}'                          => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@edit',
        'admin/files/fields'                                   => 'Anomaly\FilesModule\Http\Controller\Admin\FieldsController@index',
        'admin/files/fields/choose'                            => 'Anomaly\FilesModule\Http\Controller\Admin\FieldsController@choose',
        'admin/files/fields/create'                            => 'Anomaly\FilesModule\Http\Controller\Admin\FieldsController@create',
        'admin/files/fields/edit/{id}'                         => 'Anomaly\FilesModule\Http\Controller\Admin\FieldsController@edit',
        'admin/files/disks/assignments/{id}'                   => 'Anomaly\FilesModule\Http\Controller\Admin\AssignmentsController@index',
        'admin/files/disks/assignments/{id}/choose'            => 'Anomaly\FilesModule\Http\Controller\Admin\AssignmentsController@choose',
        'admin/files/disks/assignments/{id}/create/{field}'    => 'Anomaly\FilesModule\Http\Controller\Admin\AssignmentsController@create',
        'admin/files/disks/assignments/{id}/edit/{assignment}' => 'Anomaly\FilesModule\Http\Controller\Admin\AssignmentsController@edit',
    ];

}
