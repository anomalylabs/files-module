<?php namespace Anomaly\FilesModule\File\Form;

/**
 * Class FileFormFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Form
 */
class FileFormFields
{

    /**
     * Handle the form fields.
     *
     * @param FileFormBuilder $builder
     */
    public function handle(FileFormBuilder $builder)
    {
        $disk   = $builder->getDisk();
        $folder = $builder->getFolder();

        $builder->setFields(
            [
                'files' => [
                    'type'   => 'anomaly.field_type.files',
                    'config' => [
                        'disk' => $disk->getSlug(),
                        'path' => $folder ? $folder->path() : null
                    ]
                ]
            ]
        );
    }
}
