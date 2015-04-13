<?php namespace Anomaly\FilesModule\Folder\Contract;

use Anomaly\FilesModule\Drive\Contract\DriveInterface;

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
     * Find a folder by drive and slug
     *
     * @param DriveInterface $drive
     * @param                $slug
     * @return null|FolderInterface
     */
    public function findByDriveAndSlug(DriveInterface $drive, $slug);

    /**
     * Find a folder by drive and path.
     *
     * @param DriveInterface $drive
     * @param                $path
     * @return FolderInterface
     */
    public function findByDriveAndPath(DriveInterface $drive, $path);

    /**
     * Find a folder by parent and slug.
     *
     * @param FolderInterface $parent
     * @param                 $slug
     * @return null|FolderInterface
     */
    public function findByParentAndSlug(FolderInterface $parent, $slug);
}
