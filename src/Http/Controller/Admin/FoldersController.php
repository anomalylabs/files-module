<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Folder\Form\FolderFormBuilder;
use Anomaly\FilesModule\Folder\Table\FolderTableBuilder;
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
     * Display an index of existing entries.
     *
     * @param FolderTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FolderTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param FolderFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FolderFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param FolderFormBuilder $form
     * @param                   $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FolderFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
