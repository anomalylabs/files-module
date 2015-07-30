<?php namespace Anomaly\FilesModule\Adapter\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;

/**
 * Interface DiskLoaderInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter\Contract
 */
interface DiskLoaderInterface
{

    /**
     * Load the disk into Laravel / Flysystem.
     *
     * @param DiskInterface $disk
     */
    public function load(DiskInterface $disk);
}
