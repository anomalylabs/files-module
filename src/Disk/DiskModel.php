<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Disk\Adapter\Contract\AdapterInterface;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\FolderCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Model\Files\FilesDisksEntryModel;
use Anomaly\UsersModule\Role\RoleCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class DiskModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\Disk
 */
class DiskModel extends FilesDisksEntryModel implements DiskInterface
{

    /**
     * Cache results.
     *
     * @var int
     */
    protected $cacheMinutes = 99999;

    /**
     * Return the disk's filesystem.
     *
     * @return AdapterFilesystem
     */
    public function filesystem()
    {
        return app('filesystem')->disk($this->getSlug());
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the adapter.
     *
     * @return AdapterInterface|Extension
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Get the allowed roles.
     *
     * @return RoleCollection
     */
    public function getAllowedRoles()
    {
        return $this->allowed_roles;
    }

    /**
     * Get related folders.
     *
     * @return FolderCollection
     */
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * Return the folders relation.
     *
     * @return HasMany
     */
    public function folders()
    {
        return $this->hasMany('Anomaly\FilesModule\Folder\FolderModel', 'disk_id');
    }
}
