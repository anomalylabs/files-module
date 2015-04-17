<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Container\Container;

/**
 * Class DiskFilesystem
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk
 */
class DiskFilesystem
{

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new DiskFilesystem instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Load the disk's filesystem.
     *
     * @param DiskInterface $disk
     */
    public function load(DiskInterface $disk)
    {
        $this->container->call(substr(get_class($disk->getAdapter()), 0, -9) . 'Filesystem@load', compact('disk'));
    }
}
