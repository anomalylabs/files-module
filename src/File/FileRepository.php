<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;

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
}
