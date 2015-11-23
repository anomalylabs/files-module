<?php namespace Anomaly\FilesModule\Folder\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\FileCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface FolderInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Contract
 */
interface FolderInterface extends EntryInterface
{

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the related disk.
     *
     * @return DiskInterface
     */
    public function getDisk();

    /**
     * Get related files.
     *
     * @return FileCollection
     */
    public function getFiles();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream();

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName();

    /**
     * Return the files relation.
     *
     * @return HasMany
     */
    public function files();
}
