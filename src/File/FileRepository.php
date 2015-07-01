<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

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
     * Create a new file.
     *
     * @param array $attributes
     * @return FileInterface
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Find a file by it's name.
     *
     * @param                 $name
     * @param DiskInterface   $disk
     * @param FolderInterface $folder
     * @return null|FileInterface
     */
    public function findByName($name, DiskInterface $disk, FolderInterface $folder = null)
    {
        return $this->model
            ->where('name', $name)
            ->where('disk_id', $disk->getId())
            ->where('folder_id', $folder ? $folder->getId() : null)
            ->first();
    }

    /**
     * Delete a file.
     *
     * @param FileInterface|EloquentModel $file
     * @return bool
     */
    public function delete(FileInterface $file)
    {
        return $file->delete();
    }
}
