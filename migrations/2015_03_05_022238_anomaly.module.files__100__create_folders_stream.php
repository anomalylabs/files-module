<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFiles_100_CreateFoldersStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleFiles_100_CreateFoldersStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'folders',
        'title_column' => 'name',
        'locked'       => true
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'   => ['required' => true, 'unique' => true],
        'slug'   => ['required' => true, 'unique' => true],
        'parent' => ['required' => true],
        'drive'  => ['required' => true],
    ];

}
