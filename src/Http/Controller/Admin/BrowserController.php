<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Browser\Table\BrowserTableBuilder;
use Anomaly\FilesModule\Command\AddBreadcrumbs;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\File\Table\FileTableBuilder;
use Anomaly\FilesModule\Folder\Form\FolderFormBuilder;
use Anomaly\FilesModule\Folder\Table\FolderTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Message\MessageBag;
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
     * @param DiskRepositoryInterface $disks
     * @param BrowserTableBuilder     $browser
     * @param FolderTableBuilder      $folders
     * @param FileTableBuilder        $files
     * @param MessageBag              $messages
     * @param Request                 $request
     * @param null                    $disk
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        FolderFormBuilder $form,
        DiskRepositoryInterface $disks,
        BrowserTableBuilder $browser,
        FolderTableBuilder $folders,
        FileTableBuilder $files,
        MessageBag $messages,
        $disk = null,
        $path = null
    ) {
        if (!$disk) {

            if ($disk = $disks->first()) {
                return redirect('admin/files/browser/' . $disk->getSlug());
            }

            $messages->warning('module::message.create_disk_first');

            return redirect('admin/files/disks');
        }

        $this->dispatch(new AddBreadcrumbs());

        return $browser
            ->setOption('path', urldecode($path))
            ->setOption('disk', $disk)
            ->setOption('form', $form->make()->getFormContent())
            ->addTable('folders', $folders)
            ->addTable('files', $files)
            ->render();
    }
}
