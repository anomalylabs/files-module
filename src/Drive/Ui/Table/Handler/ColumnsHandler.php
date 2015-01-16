<?php namespace Anomaly\FilesModule\Drive\Ui\Table\Handler;

use Anomaly\FilesModule\Drive\Contract\DriveInterface;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class ColumnsHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Ui\Table\Handler
 */
class ColumnsHandler
{

    /**
     * Return the table columns.
     *
     * @return array
     */
    public function handle()
    {
        return [
            'name',
            'slug',
            [
                'heading' => 'anomaly.module.files::field.adapter.name',
                'value'   => function (DriveInterface $entry, ExtensionCollection $extensions) {
                    return trans($extensions->get($entry->getAdapter())->getName());
                }
            ]
        ];
    }
}
