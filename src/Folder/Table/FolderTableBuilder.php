<?php namespace Anomaly\FilesModule\Folder\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FolderTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FoldersModule\Folder\Table
 */
class FolderTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.edit_link',
        'slug',
        'disk',
        'entry.allowed_types.labels'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'fields'
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete'
    ];

}
