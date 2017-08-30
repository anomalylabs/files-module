<?php namespace Anomaly\FilesModule;

use Anomaly\FilesModule\Console\Clean;
use Anomaly\FilesModule\Disk\Command\LoadDisks;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Disk\DiskModel;
use Anomaly\FilesModule\Disk\DiskRepository;
use Anomaly\FilesModule\Disk\Listener\RegisterDisks;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileModel;
use Anomaly\FilesModule\File\FileRepository;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\FilesModule\Folder\FolderModel;
use Anomaly\FilesModule\Folder\FolderRepository;
use Anomaly\FilesModule\Http\Controller\Admin\AssignmentsController;
use Anomaly\FilesModule\Http\Controller\Admin\FieldsController;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Field\FieldRouter;
use Anomaly\Streams\Platform\Model\Files\FilesDisksEntryModel;
use Anomaly\Streams\Platform\Model\Files\FilesFilesEntryModel;
use Anomaly\Streams\Platform\Model\Files\FilesFoldersEntryModel;

/**
 * Class FilesModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FilesModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The commands.
     *
     * @var array
     */
    protected $commands = [
        Clean::class,
    ];

    /**
     * The plugins.
     *
     * @var array
     */
    protected $plugins = [
        FilesModulePlugin::class,
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        FilesFilesEntryModel::class   => FileModel::class,
        FilesDisksEntryModel::class   => DiskModel::class,
        FilesFoldersEntryModel::class => FolderModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        FileRepositoryInterface::class   => FileRepository::class,
        DiskRepositoryInterface::class   => DiskRepository::class,
        FolderRepositoryInterface::class => FolderRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/files'                        => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@index',
        'admin/files/choose'                 => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@choose',
        'admin/files/upload/handle'          => 'Anomaly\FilesModule\Http\Controller\Admin\UploadController@upload',
        'admin/files/upload/recent'          => 'Anomaly\FilesModule\Http\Controller\Admin\UploadController@recent',
        'admin/files/upload/{folder}'        => 'Anomaly\FilesModule\Http\Controller\Admin\UploadController@index',
        'admin/files/edit/{id}'              => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@edit',
        'admin/files/view/{id}'              => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@view',
        'admin/files/exists/{folder}/{name}' => 'Anomaly\FilesModule\Http\Controller\Admin\FilesController@exists',
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
                'path' => '(.*)',
            ],
        ],
        'files/{folder}/{name}'              => [
            'as'          => 'anomaly.module.files::files.view',
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@read',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)',
            ],
        ],
        'files/thumb/{folder}/{name}'        => [
            'as'          => 'anomaly.module.files::files.thumbnail',
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@thumbnail',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)',
            ],
        ],
        'files/stream/{folder}/{name}'       => [
            'as'          => 'anomaly.module.files::files.stream',
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@stream',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)',
            ],
        ],
        'files/download/{folder}/{name}'     => [
            'as'          => 'anomaly.module.files::files.download',
            'uses'        => 'Anomaly\FilesModule\Http\Controller\FilesController@download',
            'constraints' => [
                'disk' => '^[a-z0-9_]+$',
                'path' => '(.*)',
            ],
        ],
    ];

    /**
     * Map the addon.
     *
     * @param FieldRouter $fields
     * @param AssignmentRouter $assignments
     */
    public function map(FieldRouter $fields, AssignmentRouter $assignments)
    {
        $fields->route($this->addon, FieldsController::class);
        $assignments->route($this->addon, AssignmentsController::class, 'admin/files/folders');
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        if ($this->addon->isEnabled()) {
            $this->dispatch(new LoadDisks());
        }
    }

}
