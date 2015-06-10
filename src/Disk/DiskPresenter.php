<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class DiskPresenter
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk
 */
class DiskPresenter extends EntryPresenter
{

    /**
 * The decorated object.
 * This is for IDE support.
 *
 * @var DiskInterface
 */
    protected $object;

    /**
     * Return the browser link.
     *
     * @return string
     */
    public function browserLink()
    {
        return app('html')->link(
            implode(
                '/',
                array_filter(
                    [
                        'admin',
                        'files',
                        'browser',
                        $this->object->getSlug()
                    ]
                )
            ),
            $this->object->getName()
        );
    }
}
