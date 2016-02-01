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
        'disk'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'fields',
        'upload' => [
            'icon' => 'upload',
            'type' => 'success',
            'href' => 'admin/files/upload/{entry.slug}'
        ]
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
