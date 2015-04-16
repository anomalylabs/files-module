<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFiles_100_CreateFilesStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleFiles_100_CreateFilesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'files',
        'title_column' => 'name',
        'locked'       => true
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'folder',
        'disk'     => ['required' => true],
        'name'      => ['required' => true],
        'path'      => ['required' => true],
        'size'      => ['required' => true],
        'extension' => ['required' => true],
        'description',
        'keywords',
        'height',
        'width',
        'alt'
    ];

}
