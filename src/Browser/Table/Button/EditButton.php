<?php namespace Anomaly\FilesModule\Browser\Table\Button;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Button\Button;

/**
 * Class EditButton
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table\Button
 */
class EditButton extends Button
{

    /**
     * The button text.
     *
     * @var null|string
     */
    protected $text = 'streams::button.edit';

    /**
     * The button icon.
     *
     * @var null|string
     */
    protected $icon = 'pencil';

    /**
     * The button type.
     *
     * @var string
     */
    protected $type = 'warning';

    /**
     * Return the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->entry instanceof FileInterface || $this->entry instanceof FolderInterface;
    }
}
