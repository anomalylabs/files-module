<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface FileRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Contract
 */
interface FileRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a file by it's path.
     *
     * @param $path
     * @return null|FileInterface
     */
    public function findByPath($path);

    /**
     * Find a file by it's filename.
     *
     * @param                 $filename
     * @param FolderInterface $folder
     * @return null|FileInterface
     */
    public function findByFilename($filename, FolderInterface $folder);
}
