<?php namespace Anomaly\FilesModule\Uploader\Form;

/**
 * Class UploaderFormFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Uploader\Form
 */
class UploaderFormFields
{

    /**
     * Handle the form fields.
     *
     * @param UploaderFormBuilder $builder
     */
    public function handle(UploaderFormBuilder $builder)
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
