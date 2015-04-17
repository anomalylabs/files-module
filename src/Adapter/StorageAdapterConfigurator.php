<?php namespace Anomaly\FilesModule\Adapter;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Config\Repository;

/**
 * Class StorageAdapterConfigurator
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter
 */
class StorageAdapterConfigurator
{

    /**
     * Configure the disk.
     *
     * @param DiskInterface $disk
     * @param Repository    $config
     */
    public function configure(DiskInterface $disk, Repository $config)
    {
        $config->set("filesystems.disks.{$disk->getSlug()}.driver", $disk->getSlug());
    }
}
