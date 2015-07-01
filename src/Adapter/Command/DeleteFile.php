<?php namespace Anomaly\FilesModule\Adapter\Command;

use Anomaly\FilesModule\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\File\Contract\FileInterface;
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
 * @package       Anomaly\FilesModule\Adapter\Command
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
     * The adapter filesystem.
     *
     * @var AdapterFilesystem
     */
    protected $filesystem;

    /**
     * Create a new DeleteFile instance.
     *
     * @param File              $file
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
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     * @return FileInterface|bool
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        $folder = $folders->findByPath($this->file->getPath(), $this->filesystem->getDisk());
        $file   = $files->findByName(basename($this->file->getPath()), $this->filesystem->getDisk(), $folder);

        if ($file && $files->delete($file)) {
            return $file;
        }

        return true;
    }
}
