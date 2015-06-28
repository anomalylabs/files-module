<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use League\Flysystem\File;

/**
 * Interface FileRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Contract
 */
interface FileRepositoryInterface
{

    /**
     * Sync a file.
     *
     * @param File            $file
     * @param FolderInterface $folder
     * @param DiskInterface   $disk
     * @return FileInterface
     */
    public function sync(File $file, FolderInterface $folder = null, DiskInterface $disk);

    /**
     * Find a file by it's name.
     *
     * @param                 $name
     * @param FolderInterface $folder
     * @param DiskInterface   $disk
     * @return null|FileInterface
     */
    public function findByName($name, FolderInterface $folder = null, DiskInterface $disk);

    /**
     * Delete a file.
     *
     * @param FileInterface|EloquentModel $file
     * @return bool
     */
    public function delete(FileInterface $file);
}
