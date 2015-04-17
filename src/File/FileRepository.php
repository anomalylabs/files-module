<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use League\Flysystem\File;

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
     * Create a new FileRepository.
     *
     * @param FileModel $model
     */
    public function __construct(FileModel $model)
    {
        $this->model = $model;
    }

    /**
     * Create a file.
     *
     * @param DiskInterface   $disk
     * @param File            $file
     * @param FolderInterface $folder
     * @return FileInterface
     */
    public function create(DiskInterface $disk, File $file, FolderInterface $folder = null)
    {
        $this->model->create(
            [
                'disk_id'   => $disk->getId(),
                'size'      => $file->getSize(),
                'name'      => basename($file->getPath()),
                'folder_id' => $folder ? $folder->getId() : null,
                'extension' => pathinfo($file->getPath(), PATHINFO_EXTENSION)
            ]
        );
    }
}
