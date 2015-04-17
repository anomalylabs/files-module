<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class FilePresenter
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FilePresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var FileInterface
     */
    protected $object;

    /**
     * Return the view link.
     *
     * @return string
     */
    public function viewLink()
    {
        return app('html')->link(
            url('admin/files/browser/' . app('request')->segment(4) . '/' . $this->object->path()),
            $this->object->getName()
        );
    }
}
