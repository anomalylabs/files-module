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
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'folder',
        'filename',
        'title',
        'keywords'
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.preview' => [
            'heading' => 'anomaly.module.files::message.preview'
        ],
        'entry.edit_link',
        'folder',
        'title',
        'size'          => [
            'value' => 'entry.readable_size'
        ],
        'mime_type',
        'entry.keywords.labels'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $actions = [
        'delete',
        'edit'
    ];

}
