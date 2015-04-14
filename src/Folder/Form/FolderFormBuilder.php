<?php namespace Anomaly\FilesModule\Folder\Form;

use Anomaly\FilesModule\Drive\Command\GetDriveFromUrl;
use Anomaly\FilesModule\Folder\Command\GetFolderFromUrl;
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
     * The form model.
     *
     * @var string
     */
    protected $model = 'Anomaly\FilesModule\Folder\FolderModel';

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'name',
        'slug'
    ];

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $buttons = [
        'cancel'
    ];


    public function onSaving(FolderFormBuilder $builder)
    {
        $entry = $builder->getFormEntry();

        $drive  = $this->dispatch(new GetDriveFromUrl());
        $folder = $this->dispatch(new GetFolderFromUrl());

        dd($drive);
    }
}
