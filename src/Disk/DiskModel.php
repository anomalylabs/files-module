<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Model\Files\FilesDisksEntryModel;

/**
 * Class DiskModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
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
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        self::observe('Anomaly\FilesModule\Disk\DiskObserver');
    }

    /**
     * Return the disk's path.
     *
     * @param null $path
     * @return string
     */
    public function path($path = null)
    {
        return $this->getSlug() . '://' . ($path ? $path : $path);
    }

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
     * @return AdapterExtension
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
