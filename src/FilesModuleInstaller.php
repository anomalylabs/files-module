<?php namespace Anomaly\FilesModule;

use Anomaly\Streams\Platform\Addon\Module\ModuleInstaller;

/**
 * Class FilesModuleInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModuleInstaller extends ModuleInstaller
{

    /**
     * The module installers.
     *
     * @var array
     */
    protected $installers = [
        'Anomaly\FilesModule\Installer\FilesFieldInstaller',
        'Anomaly\FilesModule\Installer\FilesStreamInstaller',
        'Anomaly\FilesModule\Installer\FoldersStreamInstaller'
    ];

}
