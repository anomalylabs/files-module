<?php namespace Anomaly\FilesModule\Disk\Listener;

use Anomaly\FilesModule\Disk\Command\LoadDisks;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RegisterDisks
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RegisterDisks
{

    use DispatchesJobs;

    /**
     * Handle the event.
     */
    public function handle()
    {
        $this->dispatch(new LoadDisks());
    }
}
