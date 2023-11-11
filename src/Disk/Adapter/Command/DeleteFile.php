<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use League\Flysystem\FileAttributes;

/**
 * Class DeleteFile
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteFile
{

    /**
     * The file instance.
     *
     * @var FileAttributes
     */
    protected $file;

    /**
     * Create a new DeleteFile instance.
     *
     * @param FileAttributes $file
     */
    function __construct(FileAttributes $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the command.
     *
     * @param FileRepositoryInterface $files
     * @param FolderRepositoryInterface $folders
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        $folder = $folders->findBySlug(dirname($this->file->path()));
        if ($file = $files->findByNameAndFolder(basename($this->file->path()), $folder)) {
            return $files->delete($file);
        }
    }
}
