<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
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
     * Create a file.
     *
     * @param DiskInterface  $disk
     * @param File            $file
     * @param FolderInterface $folder
     * @return FileInterface
     */
    public function create(DiskInterface $disk, File $file, FolderInterface $folder = null);
}
