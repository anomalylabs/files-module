<?php namespace Anomaly\FilesModule\Drive\Table;

use Anomaly\FilesModule\Drive\Contract\DriveInterface;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class DriveTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Table
 */
class DriveTableColumns
{

    /**
     * Handle the table columns.
     *
     * @param DriveTableBuilder $builder
     */
    public function handle(DriveTableBuilder $builder)
    {
        $builder->setColumns(
            [
                'name',
                'slug',
                [
                    'heading' => 'anomaly.module.files::field.adapter.name',
                    'value'   => function (DriveInterface $entry, ExtensionCollection $extensions) {
                        return trans($extensions->get($entry->getAdapter())->getName());
                    }
                ]
            ]
        );
    }
}
