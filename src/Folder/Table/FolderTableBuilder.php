<?php namespace Anomaly\FilesModule\Folder\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FolderTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Table
 */
class FolderTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'value' => '<i class="glyphicons glyphicons-folder-closed" style="font-size: 1.7em;"></i>'
        ],
        'name' => [
            'value' => 'entry.view_link'
        ]
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit'
    ];

}
