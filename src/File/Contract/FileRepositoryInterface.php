<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

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
     * Create a new file.
     *
     * @param array $attributes
     * @return FileInterface
     */
    public function create(array $attributes);

    /**
     * Find a file by it's name.
     *
     * @param                 $name
     * @param DiskInterface   $disk
     * @param FolderInterface $folder
     * @return null|FileInterface
     */
    public function findByName($name, DiskInterface $disk, FolderInterface $folder = null);

    /**
     * Delete a file.
     *
     * @param FileInterface|EloquentModel $file
     * @return bool
     */
    public function delete(FileInterface $file);
}
