<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Adapter\AdapterExtension;
use Anomaly\FilesModule\Adapter\Contract\AdapterInterface;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Container\Container;

/**
 * Class DiskManager
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk
 */
class DiskManager
{

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new DiskManager instance.
     *
     * @param Container $container
     */
    function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Register the disk.
     *
     * @param DiskInterface $disk
     */
    public function register(DiskInterface $disk)
    {
        /* @var AdapterInterface $adapter */
        $adapter = $disk->getAdapter();

        $adapter->load($disk);
    }
}
