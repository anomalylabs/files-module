<?php namespace Anomaly\FilesModule\Folder\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\FileCollection;
use Anomaly\FilesModule\Folder\FolderCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface FolderInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Contract
 */
interface FolderInterface
{

    /**
     * Return the folder's path.
     *
     * @param null $path
     * @return string
     */
    public function path($path = null);

    /**
     * Return the folders's path on it's disk.
     *
     * @return string
     */
    public function diskPath();

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
     * Get related files.
     *
     * @return FileCollection
     */
    public function getFiles();

    /**
     * Get the related parent folder.
     *
     * @return null|FolderInterface
     */
    public function getParent();

    /**
     * Get related folders.
     *
     * @return FolderCollection
     */
    public function getChildren();

    /**
     * Return the files relation.
     *
     * @return HasMany
     */
    public function files();

    /**
     * Return folders relation.
     *
     * @return HasMany
     */
    public function children();
}
