<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Browser\Table\BrowserTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class BrowserController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class BrowserController extends AdminController
{

    /**
     * Return the file browser.
     *
     * @param BrowserTableBuilder $browser
     */
    public function index(BrowserTableBuilder $browser)
    {
        return $browser->render();
    }
}
