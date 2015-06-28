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
    protected $icon = 'duplicate';

    /**
     * The addon sections.
     *
     * @var array
     */
    protected $sections = [
        'browser' => [
            'buttons' => [
                'upload'     => [
                    'button'      => 'success',
                    'icon'        => 'upload',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal-large',
                    'href'        => 'admin/files/upload/{route.parameters_string}',
                    'text'        => 'module::button.upload',
                    'enabled'     => 'admin/files/browser/*'
                ],
                'new_folder' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'enabled'     => 'admin/files/browser/*',
                    'href'        => 'admin/files/folders/create/{route.parameters_string}'
                ]
            ]
        ],
        'disks'   => [
            'buttons' => [
                'new_disk' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/files/ajax/choose_adapter'
                ]
            ]
        ],
        'settings'
    ];

}
