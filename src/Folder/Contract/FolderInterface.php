<?php namespace Anomaly\FilesModule\Folder\Contract;

use Anomaly\FilesModule\File\FileCollection;
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
     * Get related files.
     *
     * @return FileCollection
     */
    public function getFiles();

    /**
     * Return related files.
     *
     * @return HasMany
     */
    public function files();
}
