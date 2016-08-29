<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Command\SetDimensions;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

class FileObserver extends EntryObserver
{

    /**
     * Fired before saving the file.
     *
     * @param  EntryInterface|FileInterface $entry
     * @return bool
     */
    public function saving(EntryInterface $entry)
    {
        /*
         * Make sure the resource exists.
         */
        if (!$resource = $entry->resource()) {
            return false;
        }

        $this->dispatch(new SetDimensions($entry));

        return parent::saving($entry);
    }

    /**
     * Fired after deleting the file.
     *
     * @param EntryInterface|FileInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        /*
         * Make sure the resource exists
         * and is deleted successfully.
         */
        if ($entry->isForceDeleting() && $resource = $entry->resource()) {
            $resource->delete();
        }

        parent::deleted($entry);
    }
}
