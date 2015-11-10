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
                    'data-target' => '#modal',
                    'href'        => 'admin/files/choose'
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
                'new_disk' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/files/disks/choose'
                ]
            ]
        ]
    ];

}
