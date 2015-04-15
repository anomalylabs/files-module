<?php namespace Anomaly\FilesModule\Adapter\Table;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class StorageAdapterTableEntries
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter\Table
 */
class StorageAdapterTableEntries
{

    /**
     * Handle the table entries.
     *
     * @param StorageAdapterTableBuilder $builder
     * @param ExtensionCollection        $extensions
     */
    public function handle(StorageAdapterTableBuilder $builder, ExtensionCollection $extensions)
    {
        $builder->setTableEntries($extensions->search('anomaly.module.files::storage_adapter.*'));
    }
}
