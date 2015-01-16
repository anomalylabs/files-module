<?php namespace Anomaly\FilesModule\Installer;

use Anomaly\Streams\Platform\Stream\StreamInstaller;

/**
 * Class FilesStreamInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Installer
 */
class FilesStreamInstaller extends StreamInstaller
{

    /**
     * The stream configuration.
     *
     * @var array
     */
    protected $stream = [
        'slug'   => 'files',
        'locked' => true
    ];

}
