<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Command\DeleteFolders;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class DiskObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\File
 */
class DiskObserver extends EntryObserver
{

    /**
     * Fire just before deleting an entry.
     *
     * @param EntryInterface|DiskInterface $entry
     * @return bool
     */
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteFolders($entry));

        return parent::deleting($entry);
    }
}
