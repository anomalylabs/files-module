<?php namespace Anomaly\FilesModule\Command;

use Anomaly\FilesModule\Drive\Contract\DriveRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class AddBreadcrumbs
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Command
 */
class AddBreadcrumbs implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param Request                   $request
     * @param BreadcrumbCollection      $breadcrumbs
     * @param DriveRepositoryInterface  $drives
     * @param FolderRepositoryInterface $folders
     */
    public function handle(
        Request $request,
        BreadcrumbCollection $breadcrumbs,
        DriveRepositoryInterface $drives,
        FolderRepositoryInterface $folders
    ) {
        $segments = $request->segments();

        array_shift($segments); // admin
        array_shift($segments); // files
        array_shift($segments); // browser

        $drive = $drives->findBySlug(array_shift($segments));

        $breadcrumbs->put($drive->getName(), $url = url('admin/files/browser/' . $drive->getSlug()));

        $url .= '/' . ($slug = array_shift($segments));

        $folder = $folders->findByDriveAndSlug($drive, $slug);

        if ($folder) {

            $breadcrumbs->put($folder->getName(), $url);

            foreach ($segments as $slug) {

                $url .= '/' . $slug;

                $folder = $folders->findByParentAndSlug($folder, $slug);

                $breadcrumbs->put($folder->getName(), $url);
            }
        }
    }
}
