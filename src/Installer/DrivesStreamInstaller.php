<?php namespace Anomaly\FilesModule\Installer;

use Anomaly\Streams\Platform\Stream\StreamInstaller;

/**
 * Class DrivesStreamInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Installer
 */
class DrivesStreamInstaller extends StreamInstaller
{

    /**
     * The stream configuration.
     *
     * @var array
     */
    protected $stream = [
        'slug'   => 'drives',
        'locked' => true
    ];

}
