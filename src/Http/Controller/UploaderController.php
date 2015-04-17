<?php namespace Anomaly\FilesModule\Http\Controller;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;

/**
 * Class UploaderController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller
 */
class UploaderController extends PublicController
{

    public function upload(
        Request $request,
        FilesystemManager $manager,
        DiskRepositoryInterface $disks,
        FolderRepositoryInterface $folders
    ) {
        $disk   = $disks->find($request->get('disk'));
        $folder = $folders->find($request->get('folder'));

        $file = $request->file('upload');

        if ($folder) {
            $path = $folder->path($file->getClientOriginalName());
        } else {
            $path = $file->getClientOriginalName();
        }

        $manager->disk($disk->getSlug())->put($path, $file);
    }
}
