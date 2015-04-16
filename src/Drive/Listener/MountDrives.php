<?php namespace Anomaly\FilesModule\Drive\Listener;

use Anomaly\FilesModule\Drive\Contract\DriveRepositoryInterface;
use Anomaly\FilesModule\Drive\DriveManager;

/**
 * Class MountDrives
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Listener
 */
class MountDrives
{

    /**
     * The drive repository.
     *
     * @var DriveRepositoryInterface
     */
    protected $drives;

    /**
     * The drive manager.
     *
     * @var DriveManager
     */
    protected $mounter;

    /**
     * Create a new MountDrives instance.
     *
     * @param DriveRepositoryInterface $drives
     * @param DriveManager             $manager
     */
    public function __construct(DriveRepositoryInterface $drives, DriveManager $manager)
    {
        $this->drives  = $drives;
        $this->manager = $manager;
    }


    /**
     * Handle the event.
     */
    public function handle()
    {
        foreach ($this->drives->all() as $drive) {
            $this->manager->mount($drive);
        }
    }
}
