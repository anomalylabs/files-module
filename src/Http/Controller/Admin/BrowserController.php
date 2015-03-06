<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Browser\Table\BrowserTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Routing\Redirector;

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
     * Redirect to the file browser.
     *
     * @param Redirector $redirector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(Redirector $redirector)
    {
        return $redirector->to('admin/files/browser');
    }

    /**
     * Return the file browser.
     *
     * @param BrowserTableBuilder $browser
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(BrowserTableBuilder $browser)
    {
        return $browser->render();
    }
}
