<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class FolderRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder
 */
class FolderRepository implements FolderRepositoryInterface
{

    /**
     * The folder model.
     *
     * @var FolderModel
     */
    protected $model;

    /**
     * Create a new FolderRepository instance.
     *
     * @param FolderModel $model
     */
    function __construct(FolderModel $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new folder.
     *
     * @param array $attributes
     * @return FolderInterface
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Find a folder by it's path.
     *
     * @param               $path
     * @param DiskInterface $disk
     * @return null|FolderInterface
     */
    public function findByPath($path, DiskInterface $disk)
    {
        $folder = null;

        foreach (explode('/', $path) as $name) {

            $folder = $this->findByName($name, $disk, $folder);

            if (!$folder) {
                return null;
            }
        }

        return $folder;
    }

    /**
     * Find a folder by it's name and parent folder.
     *
     * @param                 $name
     * @param DiskInterface   $disk
     * @param FolderInterface $parent
     * @return null|FolderInterface
     */
    public function findByName($name, DiskInterface $disk, FolderInterface $parent = null)
    {
        return $this->model
            ->where('name', $name)
            ->where('disk_id', $disk->getId())
            ->where('parent_id', $parent ? $parent->getId() : null)
            ->first();
    }

    /**
     * Delete a folder.
     *
     * @param FolderInterface|EloquentModel $folder
     * @return bool
     */
    public function delete(FolderInterface $folder)
    {
        return $folder->delete();
    }
}
