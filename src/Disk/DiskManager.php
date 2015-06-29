<?php namespace Anomaly\FilesModule\Disk;

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
        if ($adapter = $disk->getAdapter()) {
            $this->container->call(
                substr(get_class($adapter), 0, -9) . 'Loader@load',
                compact('disk', 'adapter')
            );
        }
    }
}
