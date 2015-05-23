<?php namespace Anomaly\FilesModule\Object;

use Anomaly\FilesModule\Object\Contract\ObjectRepositoryInterface;

/**
 * Class ObjectRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Object
 */
class ObjectRepository implements ObjectRepositoryInterface
{

    /**
     * The object model.
     *
     * @var ObjectModel
     */
    protected $model;

    /**
     * Create a new ObjectRepository instance.
     *
     * @param ObjectModel $model
     */
    public function __construct(ObjectModel $model)
    {
        $this->model = $model;
    }
}
