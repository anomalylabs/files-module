<?php namespace Anomaly\FilesModule\File\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FileTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Table
 */
class FileTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'value' => '<i class="glyphicons glyphicons-file" style="font-size: 1.7em;"></i>'
        ],
        'name' => [
            'value' => 'entry.view_link'
        ]
    ];

    /**
     * The buttons array.
     *
     * @var array
     */
    protected $buttons = [
        'edit'
    ];

}
