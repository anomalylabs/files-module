<?php namespace Anomaly\Streams\Addon\Module\Files\Installer;

use Anomaly\Streams\Platform\Field\FieldInstaller;

/**
 * Class FilesFieldInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Files\Installer
 */
class FilesFieldInstaller extends FieldInstaller
{

    /**
     * Fields to install for
     * the Files module.
     *
     * @var array
     */
    protected $fields = [
        'string_id' => [
            'type' => 'text',
        ]
    ];
}
 