<?php namespace Anomaly\FilesModule\Disk\Command;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class DeleteFolders
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\Disk\Command
 */
class DeleteFolders implements SelfHandling
{

    /**
     * The disk interface.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new DeleteFolders instance.
     *
     * @param DiskInterface $disk
     */
    public function __construct(DiskInterface $disk)
    {
        $this->disk = $disk;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     */
    public function handle(FolderRepositoryInterface $folders)
    {
        foreach ($this->disk->getFolders() as $folder) {
            $folders->forceDelete($folder);
        }
    }
}
