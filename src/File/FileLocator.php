<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class FileLocator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\File
 */
class FileLocator
{

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
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     */
    function __construct(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        $this->files   = $files;
        $this->folders = $folders;
    }

    /**
     * Locate a file by disk and path.
     *
     * @param $folder
     * @param $path
     * @return FileInterface|null
     */
    public function locate($folder, $name)
    {
        $folder = $this->folders->findBySlug($folder);

        if (!$file = $this->files->findByNameAndFolder($name, $folder)) {
            return null;
        }

        return $file;
    }
}
