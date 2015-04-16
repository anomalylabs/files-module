<?php namespace Anomaly\FilesModule\Disk\Command;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class GetDiskFromUrl
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Command
 */
class GetDiskFromUrl implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param DiskRepositoryInterface $disks
     * @param Request                  $request
     * @return DiskInterface
     */
    public function handle(DiskRepositoryInterface $disks, Request $request)
    {
        $segments = $request->segments();

        array_shift($segments); // admin
        array_shift($segments); // files
        array_shift($segments); // browser

        return $disks->findBySlug(array_shift($segments));
    }
}
