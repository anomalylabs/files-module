<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileManager;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class MoveController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MoveController extends AdminController
{

    /**
     * Return an ajax modal to choose the folder
     * to use for uploading files.
     *
     * @param FolderRepositoryInterface $folders
     * @param Authorizer $authorizer
     * @return \Illuminate\View\View
     */
    public function choose(FolderRepositoryInterface $folders, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('anomaly.module.files::files.write')) {
            abort(403);
        }

        return $this->view->make(
            'anomaly.module.files::admin/move/choose',
            [
                'folders' => $folders->all(),
            ]
        );
    }

    /**
     * @param FolderRepositoryInterface $folders
     * @param FileRepositoryInterface $files
     * @param FileManager $manager
     * @param Authorizer $authorizer
     * @param $folder
     */
    public function handle(
        FolderRepositoryInterface $folders,
        FileRepositoryInterface $files,
        FileManager $manager,
        Authorizer $authorizer,
        $folder
    ) {

        if (!$authorizer->authorize('anomaly.module.files::files.write')) {
            abort(403);
        }

        if (!$folder = $folders->findBySlug($folder)) {
            abort(400);
        }

        $count = 0;

        foreach ($selected = explode(',', request()->get('selected')) as $id) {

            /* @var FileInterface $file */
            if (!$file = $files->find($id)) {
                continue;
            }

            if ($manager->move($file->location(), $folder->path($file->getName()))) {
                $count++;
            }
        }

        $this->messages->success(trans_choice('streams::message.move_success', $count, compact('count')));

        return back();
    }
}
