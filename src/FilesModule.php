<?php namespace Anomaly\FilesModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class FilesModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'file-image';

    /**
     * The addon sections.
     *
     * @var array
     */
    protected $sections = [
        'files'   => [
            'buttons' => [
                'upload' => [
                    'data-toggle' => 'modal',
                    'icon'        => 'upload',
                    'button'      => 'success',
                    'data-target' => '#modal-large',
                    'text'        => 'module::button.upload',
                    'href'        => 'admin/files/upload/public/test_folder'
                ]
            ]
        ],
        'folders' => [
            'buttons' => [
                'new_folder'
            ]
        ],
        'disks'   => [
            'buttons' => [
                'new_disk'  => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/files/disks/choose'
                ],
                'add_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'enabled'     => 'admin/files/disks/assignments/*',
                    'href'        => 'admin/files/disks/assignments/{request.route.parameters.id}/choose'
                ]
            ]
        ],
        'fields'  => [
            'buttons' => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/files/fields/choose'
                ]
            ]
        ]
    ];

}
