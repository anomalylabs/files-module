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
                'upload' => [
                    'button'      => 'success',
                    'icon'        => 'upload',
                    'text'        => 'module::button.upload',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'files/uploader'
                ],
                'sync'   => [
                    'button' => 'success',
                    'icon'   => 'refresh',
                    'text'   => 'module::button.sync'
                ],
                'new_folder'
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
