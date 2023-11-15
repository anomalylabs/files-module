<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class FolderSynchronizer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FolderSynchronizer
{

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Create a new FolderSynchronizer instance.
     *
     * @param FolderRepositoryInterface $folders
     */
    function __construct(FolderRepositoryInterface $folders)
    {
        $this->folders = $folders;
    }

    /**
     *
     * Sync a file.
     *
     * @param $path
     * @param DiskInterface $disk
     * @return FolderInterface|\Anomaly\Streams\Platform\Model\EloquentModel|null
     */
    public function sync($path, DiskInterface $disk)
    {
        if ($path === '.') {
            return null;
        }

        if (!$folder = $this->folders->findBySlug($path)) {
            $folder = $this->folders->create(
                [
                    'name'    => $path,
                    'disk_id' => $disk->getId(),
                ]
            );
        }

        return $folder;
    }
}
