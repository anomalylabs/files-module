<?php namespace Anomaly\FilesModule\File\Upload;

/**
 * Class UploadFormFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Upload
 */
class UploadFormFields
{

    /**
     * Handle the form fields.
     *
     * @param UploadFormBuilder $builder
     */
    public function handle(UploadFormBuilder $builder)
    {
        $disk   = $builder->getDisk();
        $folder = $builder->getFolder();

        $builder->setFields(
            [
                'files' => [
                    'type'   => 'anomaly.field_type.files',
                    'config' => [
                        'disk' => $disk->getSlug(),
                        'path' => $folder ? $folder->path() : null,
                        'max'  => 32
                    ]
                ]
            ]
        );
    }
}
