<?php namespace Anomaly\FilesModule\Installer;

use Anomaly\Streams\Platform\Stream\StreamInstaller;

/**
 * Class FoldersStreamInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Installer
 */
class FoldersStreamInstaller extends StreamInstaller
{

    /**
     * The stream configuration.
     *
     * @var array
     */
    protected $stream = [
        'slug'   => 'folders',
        'locked' => true
    ];

}
