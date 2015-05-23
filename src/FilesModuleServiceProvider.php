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
        'admin/files'                        => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@choose',
        'admin/files/objects/{disk}/{path?}' => 'Anomaly\FilesModule\Http\Controller\Admin\ObjectsController@index',
        'admin/files/disks'                  => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@index',
        'admin/files/disks/create'           => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@create',
        'admin/files/disks/edit/{id}'        => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@edit',
        'admin/files/ajax/choose_adapter'    => 'Anomaly\FilesModule\Http\Controller\Admin\AjaxController@chooseAdapter',
        'admin/files/settings'               => 'Anomaly\FilesModule\Http\Controller\Admin\SettingsController@edit',
        'files/uploader'                     => 'Anomaly\FilesModule\Http\Controller\UploadController@uploader',
        'files/upload'                       => 'Anomaly\FilesModule\Http\Controller\UploadController@upload'
    ];

    /**
     * Addon route constraints.
     *
     * @var array
     */
    protected $constraints = [
        'admin/files/objects/{disk}/{path?}' => [
            'disk' => '^[a-z0-9_]+$',
            'path' => '(.*)'
        ]
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\FilesModule\Disk\DiskModel'     => 'Anomaly\FilesModule\Disk\DiskModel',
        'Anomaly\FilesModule\Object\ObjectModel' => 'Anomaly\FilesModule\Object\ObjectModel'
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface'     => 'Anomaly\FilesModule\Disk\DiskRepository',
        'Anomaly\FilesModule\Object\Contract\ObjectRepositoryInterface' => 'Anomaly\FilesModule\Object\ObjectRepository',
        'Anomaly\FilesModule\Adapter\StorageAdapterManager'             => 'Anomaly\FilesModule\Adapter\StorageAdapterManager',
        'Anomaly\FilesModule\FilesManager'                              => 'Anomaly\FilesModule\FilesManager'
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
