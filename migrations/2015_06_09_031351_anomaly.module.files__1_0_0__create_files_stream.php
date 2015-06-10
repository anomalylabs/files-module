<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFiles_1_0_0_CreateFilesStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleFiles_1_0_0_CreateFilesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'   => 'files',
        'locked' => true
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
        'folder'
    ];

}
