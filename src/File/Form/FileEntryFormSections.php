<?php namespace Anomaly\FilesModule\File\Form;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class FileEntryFormSections
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Form
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
        /* @var EntryInterface $file */
        $entry = $entryForm->getFormEntry();
        $file  = $fileForm->getFormEntry();

        $builder->setSections(
            [
                [
                    'tabs' => [
                        'file'   => [
                            'title'  => 'anomaly.module.files::tab.file',
                            'fields' => function () use ($file) {
                                return array_map(
                                    function ($slug) {
                                        return 'file_' . $slug;
                                    },
                                    $file->getAssignmentFieldSlugs()
                                );
                            }
                        ],
                        'fields' => [
                            'title'  => 'anomaly.module.files::tab.fields',
                            'fields' => function () use ($entry) {
                                return array_map(
                                    function ($slug) {
                                        return 'entry_' . $slug;
                                    },
                                    $entry->getAssignmentFieldSlugs()
                                );
                            }
                        ]
                    ]
                ]
            ]
        );
    }
}
