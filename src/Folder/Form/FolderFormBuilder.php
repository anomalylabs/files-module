<?php namespace Anomaly\FilesModule\Folder\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FolderFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FolderFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        '*',
        'slug' => [
            'disabled' => 'edit',
        ],
        'disk' => [
            'disabled' => 'edit',
        ],
    ];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [
        'disk' => [
            'tabs' => [
                'general' => [
                    'title'  => 'anomaly.module.files::tab.general',
                    'fields' => [
                        'name',
                        'slug',
                        'description',
                    ],
                ],
                'options' => [
                    'title'  => 'anomaly.module.files::tab.options',
                    'fields' => [
                        'allowed_types',
                        'disk',
                    ],
                ],
            ],
        ],
    ];
}
