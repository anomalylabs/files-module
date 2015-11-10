<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileSynchronizer;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\File;

/**
 * Class SyncFile
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Adapter\Command
 */
class SyncFile implements SelfHandling
{

    /**
     * The file instance.
     *
     * @var File
     */
    protected $file;

    /**
     * Create a new SyncFile instance.
     *
     * @param File $file
     */
    function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     * @param FileRepositoryInterface   $files
     */
    public function handle(FileSynchronizer $synchronizer)
    {
        return $synchronizer->sync($this->file, $this->getFilesystemDisk());
    }

    /**
     * Get the filesystem's disk.
     *
     * @return \Anomaly\FilesModule\Disk\Contract\DiskInterface|null
     */
    protected function getFilesystemDisk()
    {
        $filesystem = $this->file->getFilesystem();

        if ($filesystem instanceof AdapterFilesystem) {
            return $filesystem->getDisk();
        }

        return null;
    }
}
