<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class FolderPresenter
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder
 */
class FolderPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var FolderInterface
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
                        $this->object->getDisk()->getSlug(),
                        $this->object->path()
                    ]
                )
            ),
            $this->object->getName()
        );
    }
}
