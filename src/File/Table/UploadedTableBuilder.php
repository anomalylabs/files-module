<?php namespace Anomaly\FilesModule\File\Table;

use Anomaly\FilesModule\File\FileModel;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class UploadedTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Table
 */
class UploadedTableBuilder extends TableBuilder
{

    /**
     * The table model.
     *
     * @var string
     */
    protected $model = FileModel::class;

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.preview' => [
            'heading' => 'anomaly.module.files::field.preview.name'
        ],
        'name'          => [
            'sort_column' => 'name',
            'wrapper'     => '<h4>{value.link}<br><small>{value.disk}://{value.folder}/{value.file}</small><small>{value.keywords}</small></h4>',
            'value'       => [
                'link'     => 'entry.edit_link',
                'keywords' => 'entry.keywords.labels',
                'file'     => 'entry.name',
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
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'container_class'    => '',
        'no_results_message' => 'module::message.no_uploads'
    ];

}
