<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Drive\Contract\DriveRepositoryInterface;
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
     * @param DriveRepositoryInterface  $drives
     * @param Request                   $request
     * @return null|FolderInterface
     */
    public function handle(FolderRepositoryInterface $folders, DriveRepositoryInterface $drives, Request $request)
    {
        $segments = $request->segments();

        array_shift($segments); // admin
        array_shift($segments); // files
        array_shift($segments); // browser
        $drive = array_shift($segments); // drive

        $drive = $drives->findBySlug($drive);

        $folder = $folders->findDriveRoot($drive);

        foreach ($segments as $slug) {
            $folder = $folders->findByParentAndSlug($folder, $slug);
        }

        return $folder;
    }
}
