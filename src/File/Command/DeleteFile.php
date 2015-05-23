<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\Adapter\StorageAdapterFilesystem;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\File;

/**
 * Class DeleteFile
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Command
 */
class DeleteFile implements SelfHandling
{

    /**
     * The file object.
     *
     * @var File
     */
    protected $file;

    /**
     * The filesystem object.
     *
     * @var StorageAdapterFilesystem
     */
    protected $filesystem;

    /**
     * Create a new DeleteFile instance.
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
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        $folder = $folders->findByDiskAndPath($this->filesystem->getDisk(), dirname($this->file->getPath()));

        $files->create($this->filesystem->getDisk(), $this->file, $folder);
    }
}
