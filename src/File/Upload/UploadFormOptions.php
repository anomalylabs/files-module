<?php namespace Anomaly\FilesModule\File\Upload;

/**
 * Class UploadFormOptions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Upload
 */
class UploadFormOptions
{

    /**
     * Handle the form options.
     *
     * @param UploadFormBuilder $builder
     */
    public function handle(UploadFormBuilder $builder)
    {
        $folder = $builder->getFolder();

        $builder->setOptions(
            array(
                'success_message' => false,
                'title'           => $folder->getName(),
                'description'     => $folder->getDescription()
            )
        );
    }
}
