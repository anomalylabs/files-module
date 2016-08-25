<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFilesCreateFilesStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
        'title_column' => 'name',
        'trashable'    => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'      => [
            'required' => true,
        ],
        'disk'      => [
            'required' => true,
        ],
        'folder'    => [
            'required' => true,
        ],
        'extension' => [
            'required' => true,
        ],
        'size'      => [
            'required' => true,
        ],
        'mime_type' => [
            'required' => true,
        ],
        'entry'     => [
            'required' => true,
        ],
        'keywords',
        'height',
        'width',
    ];

}
