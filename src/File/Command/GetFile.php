<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Support\Decorator;


/**
 * Class GetFile
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetFile
{

    /**
     * The folder identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetFile instance.
     *
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param  FileRepositoryInterface   $files
     * @param  FolderRepositoryInterface $folders
     * @return FileInterface|EloquentModel|null
     */
    public function handle(
        FileRepositoryInterface $files,
        FolderRepositoryInterface $folders
    )
    {
        if (is_numeric($this->identifier)) {
            return $files->find($this->identifier);
        }

        if (preg_match('@[^\0]+://?(?<folder>[^\0]+)/(?<name>[^\0]+)[?$]@', $this->identifier, $match)) {
            if ($folder = $folders->findBySlug(array_get($match, 'folder'))) {
                return $files->findByNameAndFolder(array_get($match, 'name'), $folder);
            }
        }

        return null;
    }
}
