<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Image\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use League\Flysystem\File;

/**
 * Interface FileInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Contract
 */
interface FileInterface extends EntryInterface
{

    /**
     * Return the type of the file.
     *
     * @return string
     */
    public function type();

    /**
     * Return the file resource.
     *
     * @return File
     */
    public function resource();

    /**
     * Return an image instance.
     *
     * @return Image
     */
    public function image();

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the filename.
     *
     * @return string
     */
    public function getFilename();

    /**
     * Get the related disk.
     *
     * @return DiskInterface
     */
    public function getDisk();

    /**
     * Get the size.
     *
     * @return int
     */
    public function getSize();

    /**
     * Get the related folder.
     *
     * @return null|FolderInterface
     */
    public function getFolder();

    /**
     * Get the mime type.
     *
     * @return string
     */
    public function getMimeType();

    /**
     * Get the extension.
     *
     * @return string
     */
    public function getExtension();

    /**
     * Get the keywords.
     *
     * @return array
     */
    public function getKeywords();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry();

    /**
     * Return the entry relation.
     *
     * @return MorphTo
     */
    public function entry();
}
