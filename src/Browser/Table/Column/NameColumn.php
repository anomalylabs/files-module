<?php namespace Anomaly\FilesModule\Browser\Table\Column;

use Anomaly\FilesModule\Disk\DiskPresenter;
use Anomaly\FilesModule\File\FilePresenter;
use Anomaly\FilesModule\Folder\FolderPresenter;
use Anomaly\Streams\Platform\Ui\Table\Component\Column\Column;
use Robbo\Presenter\Decorator;

/**
 * Class NameColumn
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table\Column
 */
class NameColumn extends Column
{

    /**
     * The decorator.
     *
     * @var Decorator
     */
    protected $decorator;

    /**
     * Create a new NameColumn instance.
     *
     * @param Decorator $decorator
     */
    public function __construct(Decorator $decorator)
    {
        $this->decorator = $decorator;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        $object = $this->decorator->decorate($this->entry);

        if ($object instanceof FolderPresenter) {
            return '<strong>' . $object->browserLink() . '</strong>';
        }

        if ($object instanceof DiskPresenter) {
            return '<strong>' . $object->browserLink() . '</strong>';
        }

        if ($object instanceof FilePresenter) {
            return '<strong>' . $object->browserLink() . '</strong>';
        }
    }
}
