<?php namespace Anomaly\Streams\Addon\Module\Files;

use Anomaly\Streams\Platform\Addon\Module\ModuleInstaller;

/**
 * Class FilesModuleInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class FilesModuleInstaller extends ModuleInstaller
{

    /**
     * Installers to run during installation.
     *
     * @var array
     */
    protected $installers = [
        'Anomaly\Streams\Addon\Module\Files\Installer\FilesFieldInstaller',
        'Anomaly\Streams\Addon\Module\Files\Installer\FilesStreamInstaller',
    ];
}
 