<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Illuminate\Bus\Dispatcher as CommandDispatcher;
use Illuminate\Events\Dispatcher as EventDispatcher;
use League\Flysystem\MountManager;

/**
 * Class FolderObserver
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder
 */
class FolderObserver extends EntryObserver
{

    /**
     * The files repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * The mount manager.
     *
     * @var MountManager
     */
    protected $manager;

    /**
     * Create a new FolderObserver instance.
     *
     * @param MountManager              $manager
     * @param EventDispatcher           $events
     * @param CommandDispatcher         $commands
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     */
    public function __construct(
        MountManager $manager,
        EventDispatcher $events,
        CommandDispatcher $commands,
        FileRepositoryInterface $files,
        FolderRepositoryInterface $folders
    ) {
        $this->files   = $files;
        $this->folders = $folders;
        $this->manager = $manager;

        parent::__construct($events, $commands);
    }

    /**
     * Fire just before saving a folder.
     *
     * @param EntryInterface|FolderInterface $entry
     * @return bool
     */
    public function saving(EntryInterface $entry)
    {
        $disk = $entry->getDisk();

        /**
         * If the folder already exists then
         * skip it because even if it does not
         * exist on the server it'll be written
         * automatically soon.
         */
        if ($this->folders->findByName($entry->getName(), $disk, $entry->getParent())) {
            return false;
        }

        /**
         * If there was a failure then abort!
         */
        if (!$this->manager->createDir($disk->path($entry->path()))) {
            return false;
        }

        return parent::saving($entry);
    }

    /**
     * Fire just before saving a folder.
     *
     * @param EntryInterface|FolderInterface $entry
     */
    public function deleting(EntryInterface $entry)
    {
        $this->manager->deleteDir($entry->diskPath());

        // Delete contained files.
        foreach ($entry->getFiles() as $file) {
            $this->files->delete($file);
        }

        // Delete contained folders.
        foreach ($entry->getChildren() as $folder) {
            $this->folders->delete($folder);
        }
    }
}
