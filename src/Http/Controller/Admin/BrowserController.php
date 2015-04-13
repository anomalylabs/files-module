<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Browser\Table\BrowserTableBuilder;
use Anomaly\FilesModule\Folder\Table\FolderTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Http\Request;
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
     * @param Request             $request
     * @param null                $drive
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        BrowserTableBuilder $browser,
        FolderTableBuilder $folders,
        Request $request,
        $drive = null
    ) {
        $segments = $request->segments();

        array_shift($segments);
        array_shift($segments);
        array_shift($segments);

        $folder = implode('/', $segments) ?: '/';

        return $browser
            ->addTable('folders', $folders)
            ->setOption('drive', $drive)
            ->render();
    }
}
