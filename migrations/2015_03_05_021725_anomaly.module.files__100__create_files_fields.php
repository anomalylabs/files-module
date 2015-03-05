<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFiles_100_CreateFilesFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleFiles_100_CreateFilesFields extends Migration
{

    /**
     * The module fields.
     *
     * @var array
     */
    protected $fields = [
        'name'    => 'anomaly.field_type.text',
        'slug'    => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'separator' => '_'
            ]
        ],
        'adapter' => 'anomaly.field_type.text',
        'parent'  => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\FilesModule\Folder\FolderModel'
            ]
        ],
        'drive'   => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\FilesModule\Drive\DriveModel'
            ]
        ],
    ];

}
