<?php namespace Anomaly\FilesModule\File\Contract;

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
     * Find a file by it's name and folder.
     *
     * @param                 $name
     * @param FolderInterface $folder
     * @return null|FileInterface
     */
    public function findByNameAndFolder($name, FolderInterface $folder);
}
