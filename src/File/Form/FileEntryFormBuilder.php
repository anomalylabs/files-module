<?php namespace Anomaly\FilesModule\File\Form;

use Anomaly\FilesModule\Entry\Form\EntryFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class FileEntryFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Form
 */
class FileEntryFormBuilder extends MultipleFormBuilder
{

    /**
     * Fired after the entry form is saved.
     *
     * After the entry form is saved take the
     * entry and use it to populate the page
     * before it saves directly after.
     *
     * @param EntryFormBuilder $builder
     */
    public function onSavedEntry(EntryFormBuilder $builder)
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('file');

        $file = $form->getFormEntry();

        $entry = $builder->getFormEntry();

        $file->entry_id   = $entry->getId();
        $file->entry_type = get_class($entry);
    }
}
