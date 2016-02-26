<?php namespace Anomaly\FilesModule\File\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FileFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
        'name' => [
            'disabled' => true
        ],
        'keywords'
    ];

}
