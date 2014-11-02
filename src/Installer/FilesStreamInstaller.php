<?php namespace Anomaly\Streams\Addon\Module\Files\Installer;

use Anomaly\Streams\Platform\Stream\StreamInstaller;

/**
 * Class FilesStreamInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Files\Installer
 */
class FilesStreamInstaller extends StreamInstaller
{

    /**
     * Assignments for the Files stream.
     *
     * @var array
     */
    protected $assignments = [
        'string_id' => [
            'is_required' => true,
        ],
    ];
}
 