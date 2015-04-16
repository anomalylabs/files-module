<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\FilesManager;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

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
     * The files manager.
     *
     * @var FilesManager
     */
    protected $manager;

    /**
     * Create a new DiskManager instance.
     *
     * @param FilesManager $manager
     */
    public function __construct(FilesManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Mount a disk.
     *
     * @param DiskInterface $disk
     */
    public function mount(DiskInterface $disk)
    {
        $this->manager->mountFilesystem(
            $disk->getSlug(),
            new Filesystem(new Local(storage_path('streams/default/files/uploads')))
        );
    }
}
