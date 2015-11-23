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
        'mime_type',
        'keywords'
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.preview' => [
            'heading' => 'anomaly.module.files::field.preview.name'
        ],
        'filename'      => [
            'sort_column' => 'filename',
            'wrapper'     => '<h4>{value.link}<br><small>{value.disk}://{value.folder}/{value.file}</small><small>{value.keywords}</small></h4>',
            'value'       => [
                'link'     => 'entry.edit_link',
                'keywords' => 'entry.keywords.labels',
                'file'     => 'entry.filename',
                'folder'   => 'entry.folder.slug',
                'disk'     => 'entry.folder.disk.slug'
            ]
        ],
        'size'          => [
            'sort_column' => 'size',
            'value'       => 'entry.readable_size'
        ],
        'mime_type',
        'folder'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view' => [
            'target' => '_blank'
        ]
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
