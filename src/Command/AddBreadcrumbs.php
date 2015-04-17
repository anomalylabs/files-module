<?php namespace Anomaly\FilesModule\Command;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
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
     * @param DiskRepositoryInterface  $disks
     * @param FolderRepositoryInterface $folders
     */
    public function handle(
        Request $request,
        BreadcrumbCollection $breadcrumbs,
        DiskRepositoryInterface $disks,
        FolderRepositoryInterface $folders
    ) {
        $segments = $request->segments();

        array_shift($segments); // admin
        array_shift($segments); // files
        array_shift($segments); // browser

        $disk = $disks->findBySlug(array_shift($segments));

        $breadcrumbs->put($disk->getName(), $url = url('admin/files/browser/' . $disk->getSlug()));

        $url .= '/' . ($slug = array_shift($segments));

        $folder = $folders->findByDiskAndSlug($disk, $slug);

        if ($folder) {

            $breadcrumbs->put($folder->getName(), $url);

            foreach ($segments as $slug) {

                $url .= '/' . $slug;

                $folder = $folders->findByParentAndSlug($folder, urldecode($slug));

                $breadcrumbs->put($folder->getName(), $url);
            }
        }
    }
}
