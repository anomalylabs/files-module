<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class DiskRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk
 */
class DiskRepository implements DiskRepositoryInterface
{

    /**
     * The disk model.
     *
     * @var DiskModel
     */
    protected $model;

    /**
     * Create a new DiskRepository instance.
     *
     * @param DiskModel $model
     */
    public function __construct(DiskModel $model)
    {
        $this->model = $model;
    }

    /**
     * Return all disks.
     *
     * @return EntryCollection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find a disk by ID.
     *
     * @param $id
     * @return null|DiskInterface
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a disk by slug.
     *
     * @param $slug
     * @return null|DiskInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
