<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class FileObserver
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileObserver extends EntryObserver
{

    /**
     * Fired before deleting the file.
     *
     * @param EntryInterface|FileInterface $entry
     */
    public function deleting(EntryInterface $entry)
    {
        if ($resource = $entry->resource()) {
            return $resource->delete();
        }
    }
}
