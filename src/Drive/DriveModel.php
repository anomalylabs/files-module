<?php namespace Anomaly\FilesModule\Drive;

use Anomaly\FilesModule\Drive\Contract\DriveInterface;
use Anomaly\Streams\Platform\Model\Files\FilesDrivesEntryModel;

/**
 * Class DriveModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive
 */
class DriveModel extends FilesDrivesEntryModel implements DriveInterface
{

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        self::observe('Anomaly\FilesModule\Drive\DriveObserver');
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
