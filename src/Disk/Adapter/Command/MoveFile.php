<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use League\Flysystem\File;

/**
 * Class MoveFile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MoveFile
{

    /**
     * The source file.
     *
     * @var File
     */
    private $source;

    /**
     * The destination file.
     *
     * @var File
     */
    private $destination;

    /**
     * Create a new MoveFile instance.
     *
     * @param File $source
     * @param File $destination
     */
    function __construct(File $source, File $destination)
    {
        $this->source      = $source;
        $this->destination = $destination;
    }

    /**
     * Handle the command.
     *
     * @param FileRepositoryInterface $files
     * @param FolderRepositoryInterface $folders
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        dd('Test');
        /* @var FileInterface|EloquentModel $file */
        $folder = $folders->findBySlug(dirname($this->file->getPath()));
        $file   = $files->findByNameAndFolder(basename($this->from), $folder);

        return $file ? $files->save($file->setAttribute('name', basename($this->file->getPath()))) : false;
    }
}
