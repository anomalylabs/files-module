<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;

/**
 * Class BrowserTableViews
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table
 */
class BrowserTableViews
{

    /**
     * Handle the table views.
     *
     * @param BrowserTableBuilder $builder
     */
    public function handle(BrowserTableBuilder $builder, DiskRepositoryInterface $disks)
    {
        $views = [];

        $active = $builder->getOption('disk');

        /* @var DiskInterface $disk */
        foreach ($disks->all() as $disk) {
            $views[$disk->getSlug()] = [
                'text'   => $disk->getName(),
                'href'   => 'admin/files/browser/' . $disk->getSlug(),
                'active' => $disk->getSlug() === $active->getSlug()
            ];
        }

        $builder->setViews($views);
    }
}
