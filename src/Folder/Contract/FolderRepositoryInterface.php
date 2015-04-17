<?php namespace Anomaly\FilesModule\Folder\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;

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
     * Find a folder by it's ID.
     *
     * @param $id
     * @return null|FolderInterface
     */
    public function find($id);

    /**
     * Find a folder by disk and slug
     *
     * @param DiskInterface  $disk
     * @param                $slug
     * @return null|FolderInterface
     */
    public function findByDiskAndSlug(DiskInterface $disk, $slug);

    /**
     * Find a folder by disk and path.
     *
     * @param DiskInterface  $disk
     * @param                $path
     * @return FolderInterface
     */
    public function findByDiskAndPath(DiskInterface $disk, $path);

    /**
     * Find a folder by parent and slug.
     *
     * @param FolderInterface $parent
     * @param                 $slug
     * @return null|FolderInterface
     */
    public function findByParentAndSlug(FolderInterface $parent, $slug);
}
