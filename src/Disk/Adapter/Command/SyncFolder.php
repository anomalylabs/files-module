<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\FolderSynchronizer;

/**
 * Class SyncFolder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SyncFolder
{

    /**
     * The path.
     *
     * @var string
     */
    protected $path;

    /**
     * The disk interface.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new SyncFolder instance.
     *
     * @param $path
     * @param DiskInterface $disk
     */
    function __construct($path, DiskInterface $disk)
    {
        $this->path = $path;
        $this->disk = $disk;
    }

    /**
     * Handle the command.
     *
     * @param FolderSynchronizer $synchronizer
     * @return null|FolderInterface
     */
    public function handle(FolderSynchronizer $synchronizer)
    {
        return $synchronizer->sync($this->path, $this->disk);
    }
}
