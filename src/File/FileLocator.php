<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class FileLocator
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileLocator
{

    /**
     * The disk repository.
     *
     * @var DiskRepositoryInterface
     */
    protected $disks;

    /**
     * The file repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * @param DiskRepositoryInterface   $disks
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     */
    function __construct(
        DiskRepositoryInterface $disks,
        FileRepositoryInterface $files,
        FolderRepositoryInterface $folders
    ) {
        $this->disks   = $disks;
        $this->files   = $files;
        $this->folders = $folders;
    }

    /**
     * Locate a file by disk and path.
     *
     * @param $disk
     * @param $path
     * @return FileInterface|null
     */
    public function locate($disk, $path)
    {

        if (!$disk = $this->disks->findBySlug($disk)) {
            return null;
        }

        $folder = dirname($path) !== '.' ? $this->folders->findByPath(dirname($path), $disk) : null;

        if (!$file = $this->files->findByName(basename($path), $disk, $folder)) {
            return null;
        }

        return $file;
    }
}
