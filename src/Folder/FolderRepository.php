<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

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
     * Find a folder by it's path.
     *
     * @param               $path
     * @param DiskInterface $disk
     * @return null|FolderInterface
     */
    public function findByPath($path, DiskInterface $disk)
    {
        if ($path === '.') {
            return null;
        }

        $folder = null;

        foreach (explode('/', $path) as $name) {
            $folder = $this->findByName($name, $folder, $disk);
        }

        return $folder;
    }

    /**
     * Find a folder by it's path
     * or create a new one.
     *
     * @param               $path
     * @param DiskInterface $disk
     * @return null|FolderInterface
     */
    public function findByPathOrCreate($path, DiskInterface $disk)
    {
        if ($path === '.') {
            return null;
        }

        $folder = null;

        foreach (explode('/', $path) as $name) {
            $folder = $this->findByNameOrCreate($name, $folder, $disk);
        }

        return $folder;
    }

    /**
     * Find a folder by it's name and parent folder.
     *
     * @param                 $name
     * @param FolderInterface $parent
     * @param DiskInterface   $disk
     * @return FolderInterface
     */
    public function findByName($name, FolderInterface $parent = null, DiskInterface $disk)
    {
        return $this->model->where('name', $name)->where('parent_id', $parent ? $parent->getId() : null)->first();
    }

    /**
     * Find a folder by it's name and parent folder.
     *
     * @param                 $name
     * @param FolderInterface $parent
     * @param DiskInterface   $disk
     * @return FolderInterface
     */
    public function findByNameOrCreate($name, FolderInterface $parent = null, DiskInterface $disk)
    {
        $folder = $this->model->where('name', $name)->where('parent_id', $parent ? $parent->getId() : null)->first();

        if ($folder) {
            return $folder;
        }

        return $this->model->create(
            [
                'name'      => $name,
                'disk_id'   => $disk->getId(),
                'parent_id' => $parent ? $parent->getId() : null
            ]
        );
    }
}
