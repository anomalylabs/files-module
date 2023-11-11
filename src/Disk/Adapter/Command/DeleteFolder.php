<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class DeleteFolder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteFolder
{

    /**
     * The path.
     */
    protected $path;

    function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     * @return FolderInterface|bool
     */
    public function handle(FolderRepositoryInterface $folders)
    {
        if ($folder = $folders->findBySlug($this->path)) {
            $folders->delete($folder);
        }
    }
}
