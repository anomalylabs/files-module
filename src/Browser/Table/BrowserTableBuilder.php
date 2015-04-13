<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\Streams\Platform\Ui\Table\Multiple\MultipleTableBuilder;

/**
 * Class BrowserTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table
 */
class BrowserTableBuilder extends MultipleTableBuilder
{

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'test' => [
            'filter'      => 'input',
            'placeholder' => 'Search...'
        ]
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'heading' => 'Name'
        ]
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        [
            'button' => 'view',
            'href'   => 'admin/files/browser/{entry.slug}'
        ]
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => [
            'module::js/dropzone.js',
            'module::js/uploader.js'
        ],
        'styles.css' => [
            'module::less/dropzone.less',
            'module::less/browser.less',
            'module::less/uploader.less'
        ]
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'wrapper_view' => 'module::admin/browser/wrapper'
    ];

}
