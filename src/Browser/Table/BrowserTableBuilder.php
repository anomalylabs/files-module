<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\Streams\Platform\Ui\Table\Multiple\MultipleTableBuilder;

/**
 * Class BrowserTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser
 */
class BrowserTableBuilder extends MultipleTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'column' => 'Anomaly\FilesModule\Browser\Table\Column\PreviewColumn'
        ],
        [
            'heading' => 'anomaly.module.files::field.name.name',
            'column'  => 'Anomaly\FilesModule\Browser\Table\Column\NameColumn'
        ],
        [
            'heading' => 'anomaly.module.files::field.size.name',
            'column'  => 'Anomaly\FilesModule\Browser\Table\Column\SizeColumn'
        ]
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'attributes' => [
            'id' => 'browser'
        ]
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [
        'styles.css' => [
            'anomaly.module.files::less/browser.less|live'
        ]
    ];

}
