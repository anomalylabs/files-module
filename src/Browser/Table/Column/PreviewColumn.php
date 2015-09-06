<?php namespace Anomaly\FilesModule\Browser\Table\Column;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Icon\IconRegistry;
use Anomaly\Streams\Platform\Ui\Table\Component\Column\Column;

/**
 * Class PreviewColumn
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table\Column
 */
class PreviewColumn extends Column
{

    /**
     * The icon registry.
     *
     * @var IconRegistry
     */
    protected $icons;

    /**
     * Create a new PreviewColumn instance.
     *
     * @param IconRegistry $icons
     */
    public function __construct(IconRegistry $icons)
    {
        $this->icons = $icons;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        if ($this->entry instanceof DiskInterface) {
            return '<i class="' . $this->icons->get('server') . '"></i>';
        }

        if ($this->entry instanceof FolderInterface) {
            return '<i class="' . $this->icons->get('folder-closed') . '"></i>';
        }

        if ($this->entry instanceof FileInterface) {
            return '<img class="img-rounded" src="' . $this->entry->image()->thumb()->url() . '" width="48">';
        }
    }
}
