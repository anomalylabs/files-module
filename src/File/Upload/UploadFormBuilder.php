<?php namespace Anomaly\FilesModule\File\Upload;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class UploadFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Upload
 */
class UploadFormBuilder extends FormBuilder
{

    /**
     * This is an ajax form.
     *
     * @var bool
     */
    protected $ajax = true;

    /**
     * This is a model-less form.
     *
     * @var bool
     */
    protected $model = false;

    /**
     * The disk instance.
     *
     * @var null|DiskInterface
     */
    protected $disk = null;

    /**
     * The folder folder instance.
     *
     * @var null|FolderInterface
     */
    protected $folder = null;

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'done' => [
            'icon'     => 'check',
            'button'   => 'success',
            'redirect' => '{url.previous}',
            'text'     => 'anomaly.module.files::button.finished'
        ]
    ];

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $buttons = [
        'cancel' => [
            'href' => '{url.previous}'
        ]
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'success_message' => false,
        'title'           => 'anomaly.module.files::message.upload_files'
    ];

    /**
     * Fired when the builder
     * is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getDisk()) {
            throw new \Exception('The $disk parameter is required.');
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
     * Get the folder folder.
     *
     * @return FolderInterface|null
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set the folder folder.
     *
     * @param FolderInterface $folder
     * @return $this
     */
    public function setFolder(FolderInterface $folder)
    {
        $this->folder = $folder;

        return $this;
    }
}
