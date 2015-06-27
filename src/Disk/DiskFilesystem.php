<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Container\Container;
use Illuminate\Filesystem\FilesystemManager;
use League\Flysystem\MountManager;

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
     * The mount manager.
     *
     * @var MountManager
     */
    protected $manager;

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The Laravel filesystem.
     *
     * @var FilesystemManager
     */
    protected $filesystem;

    /**
     * Create a new DiskFilesystem instance.
     *
     * @param FilesystemManager $filesystem
     * @param Container         $container
     * @param MountManager      $manager
     */
    public function __construct(FilesystemManager $filesystem, Container $container, MountManager $manager)
    {
        $this->manager    = $manager;
        $this->container  = $container;
        $this->filesystem = $filesystem;
    }

    /**
     * Load the disk's filesystem.
     *
     * @param DiskInterface $disk
     */
    public function load(DiskInterface $disk)
    {
        $adapter = substr(get_class($disk->getAdapter()), 0, -9);

        /* @var AdapterFilesystem $driver */
        $driver = $this->container->call($adapter . 'Driver@make', compact('disk'));

        $driver->setDisk($disk);

        $this->filesystem->extend(
            $disk->getSlug(),
            function () use ($driver) {
                return $driver;
            }
        );

        $this->manager->mountFilesystem($disk->getSlug(), $driver);
    }
}
