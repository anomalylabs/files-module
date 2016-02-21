<?php namespace Anomaly\FilesModule\File\Table;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FileTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\File\Table
 */
class FileTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array
     */
    protected $views = [
        'all',
        'trash' => [
            'columns' => [
                'name',
                'size',
                'type'
            ]
        ]
    ];

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'search' => [
            'fields' => [
                'name',
                'keywords',
                'mime_type'
            ]
        ],
        'folder'
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.preview' => [
            'heading' => 'anomaly.module.files::field.preview.name'
        ],
        'name'          => [
            'sort_column' => 'name',
            'wrapper'     => '
                    <strong>{value.file}</strong>
                    <br>
                    <small class="text-muted">{value.disk}://{value.folder}/{value.file}</small>
                    <br>
                    <span>{value.size} {value.keywords}</span>',
            'value'       => [
                'file'     => 'entry.name',
                'folder'   => 'entry.folder.slug',
                'keywords' => 'entry.keywords.labels',
                'disk'     => 'entry.folder.disk.slug',
                'size'     => 'entry.size_label'
            ]
        ],
        'size'          => [
            'sort_column' => 'size',
            'value'       => 'entry.readable_size'
        ],
        'mime_type',
        'folder'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit',
        'view' => [
            'target' => '_blank'
        ]
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $actions = [
        'delete',
        'edit'
    ];

    /**
     * Run before querying.
     *
     * @param Guard                   $auth
     * @param Builder                 $query
     * @param DiskRepositoryInterface $disks
     */
    public function onQuerying(Guard $auth, Builder $query, DiskRepositoryInterface $disks)
    {
        $user  = $auth->user();
        $disks = $disks->all();

        /* @var UserInterface $user */
        /* @var EntryCollection $disks */
        $disks = $disks->filter(
            function (DiskInterface $disk) use ($user) {

                if ($user->isAdmin()) {
                    return true;
                }

                $roles = $disk->getAllowedRoles();

                if ($roles->isEmpty()) {
                    return true;
                }

                return $user->hasAnyRole($roles);
            }
        );

        $query->whereIn('disk_id', $disks->ids());
    }
}
