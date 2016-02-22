<?php namespace Anomaly\FilesModule\Folder\Table;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FolderTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\Folder\Table
 */
class FolderTableBuilder extends TableBuilder
{

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'search' => [
            'columns' => [
                'name',
                'slug',
                'description'
            ]
        ],
        'disk'
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'name',
        'description',
        'disk'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit',
        'assignments',
        'upload' => [
            'icon' => 'upload',
            'type' => 'success',
            'href' => 'admin/files/upload/{entry.slug}'
        ]
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete'
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
