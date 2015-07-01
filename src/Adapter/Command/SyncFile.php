<?php namespace Anomaly\FilesModule\Adapter\Command;

use Anomaly\FilesModule\Adapter\AdapterFilesystem;
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
 * @package       Anomaly\FilesModule\Adapter\Command
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
     * The adapter filesystem.
     *
     * @var AdapterFilesystem
     */
    protected $filesystem;

    /**
     * Create a new SyncFile instance.
     *
     * @param File                     $file
     * @param AdapterFilesystem $filesystem
     */
    function __construct(File $file, AdapterFilesystem $filesystem)
    {
        $this->file       = $file;
        $this->filesystem = $filesystem;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     * @param FileRepositoryInterface   $files
     */
    public function handle(FileSynchronizer $synchronizer)
    {
        $synchronizer->sync($this->file, $this->filesystem->getDisk());
    }
}
