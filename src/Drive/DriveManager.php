<?php namespace Anomaly\FilesModule\Drive;

use Anomaly\FilesModule\Drive\Contract\DriveInterface;
use Anomaly\FilesModule\FilesManager;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

/**
 * Class DriveManager
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive
 */
class DriveManager
{

    /**
     * The files manager.
     *
     * @var FilesManager
     */
    protected $manager;

    /**
     * Create a new DriveManager instance.
     *
     * @param FilesManager $manager
     */
    public function __construct(FilesManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Mount a drive.
     *
     * @param DriveInterface $drive
     */
    public function mount(DriveInterface $drive)
    {
        $this->manager->mountFilesystem($drive->getSlug(), new Filesystem(new Local(storage_path('test'))));
    }
}
