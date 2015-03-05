<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Folder\Form\FolderFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class FoldersController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class FoldersController extends AdminController
{

    /**
     * Return a form for creating a new folder.
     *
     * @param FolderFormBuilder $form
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function create(FolderFormBuilder $form)
    {
        return $form->render();
    }
}
