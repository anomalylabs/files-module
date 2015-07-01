<?php namespace Anomaly\FilesModule\Folder\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Interface FolderRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Contract
 */
interface FolderRepositoryInterface
{

    /**
     * Create a new folder.
     *
     * @param array $attributes
     * @return FolderInterface
     */
    public function create(array $attributes);

    /**
     * Find a folder by it's path.
     *
     * @param               $path
     * @param DiskInterface $disk
     * @return null|FolderInterface
     */
    public function findByPath($path, DiskInterface $disk);

    /**
     * Find a folder by it's name and parent folder.
     *
     * @param                 $name
     * @param DiskInterface   $disk
     * @param FolderInterface $parent
     * @return null|FolderInterface
     */
    public function findByName($name, DiskInterface $disk, FolderInterface $parent = null);

    /**
     * Delete a folder.
     *
     * @param FolderInterface|EloquentModel $folder
     * @return bool
     */
    public function delete(FolderInterface $folder);
}
