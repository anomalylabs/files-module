<?php namespace Anomaly\FilesModule\Adapter\Command;

use Anomaly\FilesModule\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\Directory;

/**
 * Class DeleteFolder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter\Command
 */
class DeleteFolder implements SelfHandling
{

    /**
     * The directory instance.
     *
     * @var Directory
     */
    protected $directory;

    /**
     * The adapter filesystem.
     *
     * @var AdapterFilesystem
     */
    protected $filesystem;

    /**
     * Create a new DeleteFolder instance.
     *
     * @param Directory         $directory
     * @param AdapterFilesystem $filesystem
     */
    function __construct(Directory $directory, AdapterFilesystem $filesystem)
    {
        $this->directory  = $directory;
        $this->filesystem = $filesystem;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     * @return FolderInterface|bool
     */
    public function handle(FolderRepositoryInterface $folders)
    {
        $folder = $folders->findByPath($this->directory->getPath(), $this->filesystem->getDisk());

        if ($folder && $folders->delete($folder)) {
            return $folder;
        }

        return true;
    }
}
