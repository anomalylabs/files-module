<?php namespace Anomaly\FilesModule\Disk\Listener;

use Anomaly\FilesModule\Disk\Adapter\Contract\AdapterInterface;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;

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
     * Create a new RegisterDisks instance.
     *
     * @param DiskRepositoryInterface $disks
     */
    function __construct(DiskRepositoryInterface $disks)
    {
        $this->disks = $disks;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        /* @var DiskInterface $disk */
        foreach ($this->disks->all() as $disk) {

            /* @var AdapterInterface $adapter */
            $adapter = $disk->getAdapter();

            $adapter->load($disk);
        }
    }
}
