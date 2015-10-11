<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Field\Form\FieldFormBuilder;
use Anomaly\Streams\Platform\Field\Table\FieldTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class FieldsController
 *
 * @link          http://anomaly.is/streams-platfile
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller\Admin
 */
class FieldsController extends AdminController
{

    /**
     * Return an index of existing fields.
     *
     * @param FieldTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FieldTableBuilder $table)
    {
        $table->setNamespace('files');

        return $table->render();
    }

    /**
     * Choose a field type for creating a field.
     *
     * @param FieldTypeCollection $fieldTypes
     * @return \Illuminate\View\View
     */
    public function choose(FieldTypeCollection $fieldTypes)
    {
        return view('module::ajax/choose_field_type', ['field_types' => $fieldTypes]);
    }

    /**
     * Return the file for a new field.
     *
     * @param FieldFormBuilder    $file
     * @param FieldTypeCollection $fieldTypes
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FieldFormBuilder $file, FieldTypeCollection $fieldTypes)
    {
        $file->setNamespace('files')->setFieldType($fieldTypes->get($_GET['field_type']));

        return $file->render();
    }

    /**
     * Return the file for an existing field.
     *
     * @param FieldFormBuilder $file
     * @param                  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FieldFormBuilder $file, $id)
    {
        return $file->render($id);
    }
}
