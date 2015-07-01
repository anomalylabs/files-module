<?php namespace Anomaly\FilesModule\Adapter\Command;

use Anomaly\FilesModule\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\FolderSynchronizer;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\Directory;

/**
 * Class SyncFolder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter\Command
 */
class SyncFolder implements SelfHandling
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
     * Create a new SyncFolder instance.
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
     * @param FolderSynchronizer $synchronizer
     * @return null|FolderInterface
     */
    public function handle(FolderSynchronizer $synchronizer)
    {
        return $synchronizer->sync($this->directory, $this->filesystem->getDisk());
    }
}
