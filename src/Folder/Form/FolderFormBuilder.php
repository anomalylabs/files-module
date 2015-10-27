<?php namespace Anomaly\FilesModule\Folder\Form;

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

    protected $fields = [
        'name',
        'slug' => [
            'disabled' => 'edit'
        ],
        'disk' => [
            'disabled' => 'edit'
        ]
    ];

}
