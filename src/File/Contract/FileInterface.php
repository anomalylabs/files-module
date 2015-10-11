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
     * Return a hash of the file.
     *
     * @return string
     */
    public function hash();

    /**
     * Return the type of the file.
     *
     * @return string
     */
    public function type();

    /**
     * Return the file's path.
     *
     * @return string
     */
    public function path();

    /**
     * Return the file's path on it's disk.
     *
     * @return string
     */
    public function diskPath();

    /**
     * Return the file's public path.
     *
     * @return string
     */
    public function publicPath();

    /**
     * Return the file's image path.
     *
     * @param array $parameters
     * @return string
     */
    public function imagePath(array $parameters = []);

    /**
     * Return the file's stream path.
     *
     * @return string
     */
    public function streamPath();

    /**
     * Return the file's download path.
     *
     * @return string
     */
    public function downloadPath();

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
     * Return the last modified datetime.
     *
     * @return Carbon
     */
    public function lastModified();

    /**
     * Get the alt attribute.
     *
     * @return string
     */
    public function getAlt();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

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
