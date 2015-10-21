<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFilesCreateFilesStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleFilesCreateFilesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'files',
        'title_column' => 'name'
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'      => [
            'required' => true
        ],
        'disk'      => [
            'required' => true
        ],
        'extension' => [
            'required' => true
        ],
        'size'      => [
            'required' => true
        ],
        'mime_type' => [
            'required' => true
        ],
        'entry'     => [
            'required' => true
        ],
        'path'      => [
            'required' => true
        ],
        'description',
        'keywords',
        'alt_text',
        'folder'
    ];

}
