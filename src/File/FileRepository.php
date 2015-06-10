<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use League\Flysystem\File;

/**
 * Class FileRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileRepository implements FileRepositoryInterface
{

    /**
     * The file model.
     *
     * @var FileModel
     */
    protected $model;

    /**
     * Create a new FileRepository instance.
     *
     * @param FileModel $model
     */
    function __construct(FileModel $model)
    {
        $this->model = $model;
    }

    /**
     * Sync a file.
     *
     * @param File            $file
     * @param FolderInterface $folder
     * @param DiskInterface   $disk
     * @return FileInterface
     */
    public function sync(File $file, FolderInterface $folder = null, DiskInterface $disk)
    {
        $entry = $this->model->where('name', basename($file->getPath()))->where(
            'folder_id',
            $folder ? $folder->getId() : null
        )->first();

        if (!$entry) {
            $entry = $this->model->newInstance();
        }

        $entry->fill(
            [
                'name'      => basename($file->getPath()),
                'folder_id' => $folder ? $folder->getId() : null,
                'disk_id'   => $disk->getId(),
                'size'      => $file->getSize(),
                'mime_type' => $file->getMimetype(),
                'extension' => pathinfo($file->getPath(), PATHINFO_EXTENSION)
            ]
        );

        $entry->save();

        return $entry;
    }

    /**
     * Find a file by it's name.
     *
     * @param                 $name
     * @param FolderInterface $folder
     * @param DiskInterface   $disk
     * @return null|FileInterface
     */
    public function findByName($name, FolderInterface $folder = null, DiskInterface $disk)
    {
        return $this->model
            ->where('name', $name)
            ->where('folder_id', $folder ? $folder->getId() : null)
            ->where('disk_id', $disk->getId())
            ->first();
    }
}
