<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use League\Flysystem\Directory;

/**
 * Class FolderSynchronizer
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder
 */
class FolderSynchronizer
{

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Create a new FolderSynchronizer instance.
     *
     * @param FolderRepositoryInterface $folders
     */
    function __construct(FolderRepositoryInterface $folders)
    {
        $this->folders = $folders;
    }

    /**
     * Sync a file.
     *
     * @param Directory     $resource
     * @param DiskInterface $disk
     * @return null|FolderInterface
     */
    public function sync(Directory $resource, DiskInterface $disk)
    {
        $path = $resource->getPath();

        if ($path === '.') {
            return null;
        }

        /* @var FolderInterface|null $parent */
        $parent = null;
        $folder = null;

        foreach (explode('/', $path) as $name) {
            if (!$folder = $this->folders->findByName($name, $disk, $parent)) {
                $folder = $this->folders->create(
                    [
                        'name'      => $name,
                        'disk_id'   => $disk->getId(),
                        'parent_id' => $parent ? $parent->getId() : null
                    ]
                );
            }

            $parent = $folder;
        }

        return $folder;
    }
}
