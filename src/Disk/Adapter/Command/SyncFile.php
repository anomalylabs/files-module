<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileSynchronizer;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use League\Flysystem\FileAttributes;

/**
 * Class SyncFile
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SyncFile
{

    /**
     * The file instance.
     *
     * @var FileAttributes
     */
    protected $file;

    /**
     * The disk instance.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new SyncFile instance.
     *
     * @param FileAttributes $file
     * @param DiskInterface $disk
     */
    function __construct(FileAttributes $file, DiskInterface $disk)
    {
        $this->file = $file;
        $this->disk = $disk;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     * @param FileRepositoryInterface $files
     */
    public function handle(FileSynchronizer $synchronizer)
    {
        return $synchronizer->sync($this->file, $this->disk);
    }
}
