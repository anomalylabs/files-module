<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Folder\Command\DeleteDirectory;
use Anomaly\FilesModule\Folder\Command\DeleteFiles;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

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
     * Fire just before deleting a folder.
     *
     * @param EntryInterface|FolderInterface $entry
     */
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteFiles($entry));
        $this->dispatch(new DeleteDirectory($entry));
    }
}
