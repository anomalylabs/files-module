<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use League\Flysystem\File;

/**
 * Class FileSynchronizer
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileSynchronizer
{

    /**
     * The files repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Create a new FileSynchronizer instance.
     *
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     */
    function __construct(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        $this->files   = $files;
        $this->folders = $folders;
    }

    /**
     * Sync a file.
     *
     * @param File          $resource
     * @param DiskInterface $disk
     * @return FileInterface
     */
    public function sync(File $resource, DiskInterface $disk)
    {
        $folder = $this->syncFolder($resource, $disk);

        if (!$file = $this->files->findByName(basename($resource->getPath()), $folder, $disk)) {
            $file = $this->files->create(
                [
                    'name'      => basename($resource->getPath()),
                    'folder_id' => $folder ? $folder->getId() : null,
                    'disk_id'   => $disk->getId(),
                    'size'      => $resource->getSize(),
                    'mime_type' => $resource->getMimetype(),
                    'extension' => pathinfo($resource->getPath(), PATHINFO_EXTENSION)
                ]
            );
        }

        return $file;
    }

    /**
     * Sync the files folder.
     *
     * @param File          $resource
     * @param DiskInterface $disk
     * @return null|FolderInterface
     */
    protected function syncFolder(File $resource, DiskInterface $disk)
    {
        $folder = dirname($resource->getPath());

        if ($folder === '.') {
            return null;
        }

        foreach (explode('/', $folder) as $name) {

            /* @var FolderInterface|null $parent */
            $parent = null;

            if (!$folder = $this->folders->findByName($name, $parent, $disk)) {
                $folder = $parent = $this->folders->create(
                    [
                        'name'      => $name,
                        'disk_id'   => $disk->getId(),
                        'parent_id' => $parent ? $parent->getId() : null
                    ]
                );
            }
        }

        return $folder;
    }
}
