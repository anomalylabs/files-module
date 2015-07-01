<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFiles_100_CreateFilesFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleFiles_1_0_0_CreateFilesFields extends Migration
{

    /**
     * The module fields.
     *
     * @var array
     */
    protected $fields = [
        'name'        => 'anomaly.field_type.text',
        'slug'        => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'type'    => '_',
                'slugify' => 'name'
            ]
        ],
        'adapter'     => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'type'   => 'extensions',
                'search' => 'anomaly.module.files::adapter.*'
            ]
        ],
        'parent'      => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\FilesModule\Folder\FolderModel'
            ]
        ],
        'folder'      => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\FilesModule\Folder\FolderModel'
            ]
        ],
        'disk'        => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\FilesModule\Disk\DiskModel'
            ]
        ],
        'description' => 'anomaly.field_type.textarea',
        'extension'   => 'anomaly.field_type.text',
        'keywords'    => 'anomaly.field_type.tags',
        'alt'         => 'anomaly.field_type.text',
        'width'       => 'anomaly.field_type.text',
        'height'      => 'anomaly.field_type.text',
        'mime_type'   => 'anomaly.field_type.text',
        'size'        => 'anomaly.field_type.integer'
    ];

}
