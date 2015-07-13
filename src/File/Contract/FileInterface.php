<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Carbon\Carbon;
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
     * Return the last modified datetime.
     *
     * @return Carbon
     */
    public function lastModified();

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId();

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
}
