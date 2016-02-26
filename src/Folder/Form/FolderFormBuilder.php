<?php namespace Anomaly\FilesModule\Folder\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FolderFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\Folder\Form
 */
class FolderFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'name',
        'slug' => [
            'disabled' => 'edit'
        ],
        'description',
        'allowed_types',
        'disk' => [
            'disabled' => 'edit'
        ]
    ];

}
