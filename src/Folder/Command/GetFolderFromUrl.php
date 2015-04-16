<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;

/**
 * Class GetFolderFromUrl
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Command
 */
class GetFolderFromUrl implements SelfHandling
{

    use DispatchesCommands;

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     * @param DiskRepositoryInterface  $disks
     * @param Request                   $request
     * @return null|FolderInterface
     */
    public function handle(FolderRepositoryInterface $folders, DiskRepositoryInterface $disks, Request $request)
    {
        $segments = $request->segments();

        array_shift($segments); // admin
        array_shift($segments); // files
        array_shift($segments); // browser
        $disk = array_shift($segments); // disk

        $disk = $disks->findBySlug($disk);

        $folder = $folders->findByDiskAndPath($disk, implode('/', $segments));

        return $folder;
    }
}
