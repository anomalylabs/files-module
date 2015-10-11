<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Command\CreateDiskEntriesStream;
use Anomaly\FilesModule\Disk\Command\DeleteDiskEntriesStream;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class DiskObserver
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class DiskObserver extends EntryObserver
{

    /**
     * Fired after saving the entry.
     *
     * @param EntryInterface|DiskInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        $this->dispatch(new CreateDiskEntriesStream($entry));

        parent::saved($entry);
    }

    /**
     * Fired after deleting the entry.
     *
     * @param EntryInterface|DiskInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->dispatch(new DeleteDiskEntriesStream($entry));

        parent::deleted($entry);
    }
}
