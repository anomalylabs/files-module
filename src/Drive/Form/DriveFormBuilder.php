<?php namespace Anomaly\FilesModule\Drive\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class DriveFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Form
 */
class DriveFormBuilder extends FormBuilder
{

    /**
     * The form model.
     *
     * @var string
     */
    protected $model = 'Anomaly\FilesModule\Drive\DriveModel';

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'adapter',
        'name',
        'slug'
    ];

}
