<?php namespace Anomaly\FilesModule\Disk\Adapter\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;

/**
 * Interface AdapterInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\Disk\Adapter\Contract
 */
interface AdapterInterface
{

    /**
     * Load the disk.
     *
     * @param DiskInterface $disk
     */
    public function load(DiskInterface $disk);
}
