<?php namespace Anomaly\FilesModule\Adapter\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class StorageAdapterTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter\Table
 */
class StorageAdapterTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'heading' => 'streams::addon.name',
            'value'   => 'entry.name'
        ],
        [
            'heading' => 'streams::addon.description',
            'value'   => 'entry.description'
        ]
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'settings'
    ];

}
