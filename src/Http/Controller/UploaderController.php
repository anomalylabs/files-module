<?php namespace Anomaly\FilesModule\Http\Controller;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\FilesManager;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
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
        FilesManager $manager,
        FileRepositoryInterface $files,
        DiskRepositoryInterface $disks,
        FolderRepositoryInterface $folders
    ) {
        $disk  = $disks->find($request->get('disk'));
        $folder = $folders->find($request->get('folder'));

        $file = $request->file('upload');

        $stream = fopen($file->getRealPath(), 'r+');

        $manager->putStream($disk->getSlug() . '://' . $file->getClientOriginalName(), $stream);

        $file = $manager->get($disk->getSlug() . '://' . $file->getClientOriginalName());

        $files->create($disk, $file, $folder);
    }
}
