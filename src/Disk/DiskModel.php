<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Adapter\AdapterExtension;
use Anomaly\FilesModule\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Adapter\Contract\AdapterInterface;
use Anomaly\FilesModule\Disk\Command\GetDiskEntriesStream;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Model\Files\FilesDisksEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

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
        self::observe(app(substr(__CLASS__, 0, -5) . 'Observer'));

        parent::boot();
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
     * @return AdapterInterface|Extension
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Get the entries stream.
     *
     * @return StreamInterface
     */
    public function getEntriesStream()
    {
        return $this->dispatch(new GetDiskEntriesStream($this));
    }
}
