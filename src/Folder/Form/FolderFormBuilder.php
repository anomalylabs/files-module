<?php namespace Anomaly\FilesModule\Folder\Form;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FolderFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Form
 */
class FolderFormBuilder extends FormBuilder
{

    /**
     * This is an ajax form.
     *
     * @var bool
     */
    protected $ajax = true;

    /**
     * The disk instance.
     *
     * @var null|DiskInterface
     */
    protected $disk = null;

    /**
     * The parent folder instance.
     *
     * @var null|FolderInterface
     */
    protected $parent = null;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'name'
    ];

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'save' => [
            'redirect' => '{url.previous}'
        ]
    ];

    /**
     * Fired when the builder
     * is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getDisk() && !$this->getEntry()) {
            throw new \Exception('The $disk parameter is required when creating a folder.');
        }
    }

    /**
     * Fire just before saving the entry.
     */
    public function onSaving()
    {
        $entry  = $this->getFormEntry();
        $parent = $this->getParent();
        $disk   = $this->getDisk();

        if ($disk) {
            $entry->disk = $disk->getId();
        }

        if ($parent) {
            $entry->parent_id = $parent->getId();
        }
    }

    /**
     * Get the disk.
     *
     * @return DiskInterface|null
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * Set the disk.
     *
     * @param DiskInterface $disk
     * @return $this
     */
    public function setDisk(DiskInterface $disk)
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * Get the parent folder.
     *
     * @return FolderInterface|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent folder.
     *
     * @param FolderInterface $parent
     * @return $this
     */
    public function setParent(FolderInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
