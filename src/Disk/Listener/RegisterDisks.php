<?php namespace Anomaly\FilesModule\Disk\Listener;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Disk\DiskManager;

/**
 * Class RegisterDisks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Listener
 */
class RegisterDisks
{

    /**
     * The disk repository.
     *
     * @var DiskRepositoryInterface
     */
    protected $disks;

    /**
     * The adapter manager.
     *
     * @var DiskManager
     */
    protected $manager;

    /**
     * Create a new RegisterDisks instance.
     *
     * @param DiskRepositoryInterface $disks
     * @param DiskManager             $manager
     */
    function __construct(DiskRepositoryInterface $disks, DiskManager $manager)
    {
        $this->disks   = $disks;
        $this->manager = $manager;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        /* @var DiskInterface $disk */
        foreach ($this->disks->all() as $disk) {
            $this->manager->register($disk);
        }
    }
}
