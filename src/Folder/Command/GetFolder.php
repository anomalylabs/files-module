<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class GetFolder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetFolder
{

    /**
     * The folder identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetFolder instance.
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
     * @param  FolderRepositoryInterface $folders
     * @return FolderInterface|EloquentModel|null
     */
    public function handle(FolderRepositoryInterface $folders)
    {
        if (is_string($this->identifier)) {
            if ($folder = $folders->findBySlug($this->identifier)) {
                return $folder;
            }
        }

        if (is_numeric($this->identifier)) {
            if ($folder = $folders->find($this->identifier)) {
                return $folder;
            }
        }

        return null;
    }
}
