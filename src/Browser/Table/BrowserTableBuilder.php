<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class BrowserTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table
 */
class BrowserTableBuilder extends TableBuilder
{

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
     * Create a new BrowserTableBuilder instance.
     *
     * @param Table $table
     * @param Asset $asset
     */
    public function __construct(Table $table, Asset $asset)
    {
        $asset->add('scripts.js', 'module::js/dropzone.js');
        $asset->add('scripts.js', 'module::js/uploader.js', ['debug']);
        $asset->add('styles.css', 'module::less/dropzone.less', ['debug']);
        $asset->add('styles.css', 'module::less/browser.less', ['debug']);
        $asset->add('styles.css', 'module::less/uploader.less', ['debug']);

        $table->setOption('wrapper_view', 'module::admin/browser/wrapper');

        parent::__construct($table);
    }
}
