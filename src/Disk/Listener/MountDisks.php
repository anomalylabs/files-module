<?php namespace Anomaly\FilesModule\Disk\Listener;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Disk\DiskManager;

/**
 * Class MountDisks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Listener
 */
class MountDisks
{

    /**
     * The disk repository.
     *
     * @var DiskRepositoryInterface
     */
    protected $disks;

    /**
     * The disk manager.
     *
     * @var DiskManager
     */
    protected $mounter;

    /**
     * Create a new MountDisks instance.
     *
     * @param DiskRepositoryInterface $disks
     * @param DiskManager             $manager
     */
    public function __construct(DiskRepositoryInterface $disks, DiskManager $manager)
    {
        $this->disks  = $disks;
        $this->manager = $manager;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        foreach ($this->disks->all() as $disk) {
            $this->manager->mount($disk);
        }
    }
}
