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
    public function __construct(FolderModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a folder by it's ID.
     *
     * @param $id
     * @return null|FolderInterface
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a folder by disk and slug
     *
     * @param DiskInterface  $disk
     * @param                $slug
     * @return null|FolderInterface
     */
    public function findByDiskAndSlug(DiskInterface $disk, $slug)
    {
        return $this->model->where('disk_id', $disk->getId())->whereIn('parent_id', [null, ''])->where(
            'slug',
            $slug
        )->first();
    }

    /**
     * Find a folder by disk and path.
     *
     * @param DiskInterface  $disk
     * @param                $path
     * @return FolderInterface
     */
    public function findByDiskAndPath(DiskInterface $disk, $path)
    {
        if ($path == '.') {
            return null;
        }

        $slugs = explode('/', $path);

        $folder = $this->findByDiskAndSlug($disk, array_shift($slugs));

        foreach ($slugs as $slug) {
            $folder = $this->findByParentAndSlug($folder, $slug);
        }

        return $folder;
    }

    /**
     * Find a folder by parent and slug.
     *
     * @param FolderInterface $parent
     * @param                 $slug
     * @return null|FolderInterface
     */
    public function findByParentAndSlug(FolderInterface $parent, $slug)
    {
        return $this->model->where('parent_id', $parent->getId())->where('slug', $slug)->first();
    }
}
