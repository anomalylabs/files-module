<?php namespace Anomaly\FilesModule\Folder;

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
}
