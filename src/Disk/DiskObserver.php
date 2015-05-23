<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class DiskObserver
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk
 */
class DiskObserver extends EntryObserver
{

    /**
     * Fired after deleting a disk.
     *
     * @param EntryInterface|DiskInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        parent::deleted($entry);
    }
}
