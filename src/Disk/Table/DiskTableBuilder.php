<?php namespace Anomaly\FilesModule\Disk\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class DiskTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Table
 */
class DiskTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'name',
        'slug',
        'entry.adapter.name'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit',
        'blue' => [
            'href' => 'admin/files/browser/{entry.slug}',
            'text' => 'anomaly.module.files::button.browse'
        ]
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'reorder',
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'name' => 'ASC'
        ]
    ];

}
