<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\Container\Form\ContainerFormBuilder;
use Anomaly\FilesModule\Container\Table\ContainerTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ContainersController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ContainerTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ContainerTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ContainerFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ContainerFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ContainerFormBuilder $form
     * @param                      $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ContainerFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
