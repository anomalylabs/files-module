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
     * Return the icon.
     *
     * @return string
     */
    public function icon()
    {
        return '<i class="glyphicons glyphicons-folder-closed"></i>';
    }

    /**
     * Return the view link.
     *
     * @return string
     */
    public function viewLink()
    {
        $name = $this->object->getName();
        $slug = $this->object->getSlug();

        return app('html')
            ->link(app('request')->path() . '/' . $slug, $name);
    }
}
