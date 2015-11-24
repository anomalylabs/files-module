<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class FileRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileRepository extends EntryRepository implements FileRepositoryInterface
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

    /**
     * Find a file by it's path.
     *
     * @param $path
     * @return null|FileInterface
     */
    public function findByPath($path)
    {
        return $this->model->where('path', $path)->first();
    }

    /**
     * Find a file by it's name.
     *
     * @param                 $name
     * @param FolderInterface $folder
     * @return null|FileInterface
     */
    public function findByName($name, FolderInterface $folder = null)
    {
        return $this->model
            ->where('name', $name)
            ->where('folder_id', $folder->getId())
            ->first();
    }
}
