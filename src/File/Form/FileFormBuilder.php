<?php namespace Anomaly\FilesModule\File\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FileFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Form
 */
class FileFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'title',
        'name' => [
            'disabled' => true
        ],
        'keywords',
        'description'
    ];

}
