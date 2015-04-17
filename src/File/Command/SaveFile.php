<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\FilesModule\Support\Filesystem;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\File;

/**
 * Class SaveFile
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Command
 */
class SaveFile implements SelfHandling
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
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Create a new SaveFile instance.
     *
     * @param File       $file
     * @param Filesystem $filesystem
     */
    function __construct(File $file, Filesystem $filesystem)
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
