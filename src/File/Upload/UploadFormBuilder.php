<?php namespace Anomaly\FilesModule\File\Upload;

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
     * This is a model-less form.
     *
     * @var bool
     */
    protected $model = false;

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
            'redirect' => 'admin/files'
        ]
    ];

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $buttons = [
        'cancel'
    ];

    /**
     * Fired when the builder
     * is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getFolder()) {
            throw new \Exception('The $folder parameter is required.');
        }
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
