<?php namespace Anomaly\FilesModule\Browser\Table\Column;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Column\Column;

/**
 * Class MimeTypeColumn
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table\Column
 */
class MimeTypeColumn extends Column
{

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        if ($this->entry instanceof FolderInterface) {
            return '-';
        }

        if ($this->entry instanceof FileInterface) {
            return $this->entry->getMimeType();
        }
    }
}
