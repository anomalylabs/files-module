<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
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
 * @package       Anomaly\FilesModule\Disk\Adapter\Command
 */
class DeleteFile implements SelfHandling
{

    /**
     * The file instance.
     *
     * @var File
     */
    protected $file;

    /**
     * Create a new DeleteFile instance.
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
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        $folder = $folders->findBySlug(dirname($this->file->getPath()));
        $file   = $files->findByName(basename($this->file->getPath()), $folder);

        if ($file) {
            $files->delete($file);
        }
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
