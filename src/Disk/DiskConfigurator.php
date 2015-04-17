<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Container\Container;

/**
 * Class DiskConfigurator
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk
 */
class DiskConfigurator
{

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new DiskConfigurator instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Configure a disk for Laravel.
     *
     * @param DiskInterface $disk
     */
    public function configure(DiskInterface $disk)
    {
        $configurator = substr(get_class($disk->getAdapter()), 0, -9) . 'Configurator';

        if (!class_exists($configurator)) {
            $configurator = 'Anomaly\FilesModule\Adapter\StorageAdapterConfigurator';
        }

        $this->container->call($configurator . '@configure', compact('disk'));
    }
}
