<?php namespace Anomaly\FilesModule\File\Form;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class FileEntryFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param FileEntryFormBuilder $builder
     */
    public function handle(FileEntryFormBuilder $builder)
    {
        $entryForm = $builder->getChildForm('entry');
        $fileForm  = $builder->getChildForm('file');

        /* @var EntryInterface $entry */
        $entry = $entryForm->getFormEntry();

        $builder->setSections(
            [
                'file'   => [
                    'fields' => function () use ($fileForm) {
                        return array_map(
                            function ($field) {
                                return 'file_' . $field['field'];
                            },
                            $fileForm->getFields()
                        );
                    },
                ],
                'fields' => [
                    'fields' => function () use ($entry) {
                        return array_map(
                            function ($slug) {
                                return 'entry_' . $slug;
                            },
                            $entry->getAssignmentFieldSlugs()
                        );
                    },
                ],
            ]
        );
    }
}
