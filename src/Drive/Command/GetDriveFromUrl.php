<?php namespace Anomaly\FilesModule\Drive\Command;

use Anomaly\FilesModule\Drive\Contract\DriveInterface;
use Anomaly\FilesModule\Drive\Contract\DriveRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class GetDriveFromUrl
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Command
 */
class GetDriveFromUrl implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param DriveRepositoryInterface $drives
     * @param Request                  $request
     * @return DriveInterface
     */
    public function handle(DriveRepositoryInterface $drives, Request $request)
    {
        $segments = $request->segments();

        array_shift($segments); // admin
        array_shift($segments); // files
        array_shift($segments); // browser

        return $drives->findBySlug(array_shift($segments));
    }
}
