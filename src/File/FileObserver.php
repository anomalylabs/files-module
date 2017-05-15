<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Command\DeleteResource;
use Anomaly\FilesModule\File\Command\SetDimensions;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class FileObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
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
        $this->dispatch(new DeleteResource($entry));

        parent::deleted($entry);
    }
}
