<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
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
     * Find a file by it's filename.
     *
     * @param                 $filename
     * @param DiskInterface   $disk
     * @param FolderInterface $folder
     * @return null|FileInterface
     */
    public function findByFilename($filename, DiskInterface $disk, FolderInterface $folder = null)
    {
        return $this->model
            ->where('filename', $filename)
            ->where('disk_id', $disk->getId())
            ->where('folder_id', $folder ? $folder->getId() : null)
            ->first();
    }
}
