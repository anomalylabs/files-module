<?php namespace Anomaly\FilesModule\Disk\Listener;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Disk\DiskConfigurator;
use Anomaly\FilesModule\Disk\DiskFilesystem;
use Illuminate\Config\Repository;
use Illuminate\Filesystem\FilesystemManager;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

/**
 * Class ExtendFilesystem
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Listener
 */
class ExtendFilesystem
{

    /**
     * The disk repository.
     *
     * @var DiskRepositoryInterface
     */
    protected $disks;

    /**
     * The disk configurator.
     *
     * @var DiskConfigurator
     */
    protected $configurator;

    /**
     * The filesystem extender.
     *
     * @var DiskFilesystem
     */
    protected $filesystem;

    /**
     * Create a new ExtendFilesystem instance.
     *
     * @param DiskRepositoryInterface $disks
     * @param DiskConfigurator        $configurator
     * @param DiskFilesystem          $filesystem
     */
    public function __construct(
        DiskRepositoryInterface $disks,
        DiskConfigurator $configurator,
        DiskFilesystem $filesystem
    ) {
        $this->disks        = $disks;
        $this->configurator = $configurator;
        $this->filesystem   = $filesystem;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {return;
        foreach ($this->disks->all() as $disk) {
            $this->configurator->configure($disk);
            $this->filesystem->load($disk);
        }
    }
}
