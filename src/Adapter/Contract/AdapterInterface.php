<?php namespace Anomaly\FilesModule\Adapter\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;

/**
 * Interface AdapterInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter\Contract
 */
interface AdapterInterface
{

    /**
     * Load the disk.
     *
     * @param DiskInterface $disk
     */
    public function load(DiskInterface $disk);

    /**
     * Validate adapter configuration.
     *
     * @param array $configuration
     * @return bool
     */
    public function validate(array $configuration);
}
