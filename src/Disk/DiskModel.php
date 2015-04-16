<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Model\Files\FilesDisksEntryModel;

/**
 * Class DiskModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk
 */
class DiskModel extends FilesDisksEntryModel implements DiskInterface
{

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        self::observe('Anomaly\FilesModule\Disk\DiskObserver');
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the adapter.
     *
     * @return string
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
