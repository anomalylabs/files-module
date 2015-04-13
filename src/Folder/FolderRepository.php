<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Drive\Contract\DriveInterface;
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
     * Find a folder by drive and slug
     *
     * @param DriveInterface $drive
     * @param                $slug
     * @return null|FolderInterface
     */
    public function findByDriveAndSlug(DriveInterface $drive, $slug)
    {
        return $this->model->where('drive_id', $drive->getId())->whereIn('parent_id', [null, ''])->where(
            'slug',
            $slug
        )->first();
    }

    /**
     * Find a folder by drive and path.
     *
     * @param DriveInterface $drive
     * @param                $path
     * @return FolderInterface
     */
    public function findByDriveAndPath(DriveInterface $drive, $path)
    {
        $slugs = explode('/', $path);

        $folder = $this->findByDriveAndSlug($drive, array_shift($slugs));

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
