<?php namespace Anomaly\FilesModule\Drive;

use Anomaly\FilesModule\Drive\Contract\DriveInterface;
use Anomaly\FilesModule\Drive\Contract\DriveRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class DriveRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive
 */
class DriveRepository implements DriveRepositoryInterface
{

    /**
     * The drive model.
     *
     * @var DriveModel
     */
    protected $model;

    /**
     * Create a new DriveRepository instance.
     *
     * @param DriveModel $model
     */
    public function __construct(DriveModel $model)
    {
        $this->model = $model;
    }

    /**
     * Return all drives.
     *
     * @return EntryCollection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Return the first drive.
     *
     * @return null|DriveInterface
     */
    public function first()
    {
        return $this->model->orderBy('sort_order', 'ASC')->first();
    }
}
