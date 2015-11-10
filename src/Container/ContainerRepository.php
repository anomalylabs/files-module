<?php namespace Anomaly\FilesModule\Container;

use Anomaly\FilesModule\Container\Contract\ContainerRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ContainerRepository extends EntryRepository implements ContainerRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ContainerModel
     */
    protected $model;

    /**
     * Create a new ContainerRepository instance.
     *
     * @param ContainerModel $model
     */
    public function __construct(ContainerModel $model)
    {
        $this->model = $model;
    }
}
