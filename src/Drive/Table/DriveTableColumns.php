<?php namespace Anomaly\FilesModule\Drive\Table;

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
                'adapter'
            ]
        );
    }
}
