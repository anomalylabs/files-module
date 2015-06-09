<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\Adapter\StorageAdapterFilesystem;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\File;

/**
 * Class SyncFile
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Command
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
     * @var StorageAdapterFilesystem
     */
    protected $filesystem;

    /**
     * Create a new SyncFile instance.
     *
     * @param File                     $file
     * @param StorageAdapterFilesystem $filesystem
     */
    function __construct(File $file, StorageAdapterFilesystem $filesystem)
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
    public function handle(FolderRepositoryInterface $folders, FileRepositoryInterface $files)
    {
        $files->sync(
            $this->file,
            $folders->findByPathOrCreate(dirname($this->file->getPath()), $this->filesystem->getDisk()),
            $this->filesystem->getDisk()
        );
    }
}
