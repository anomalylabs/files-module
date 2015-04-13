<?php namespace Anomaly\FilesModule\Drive\Form;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class DriveFormFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Form
 */
class DriveFormFields
{

    /**
     * Handle the fields.
     *
     * @param DriveFormBuilder $builder
     */
    public function handle(DriveFormBuilder $builder)
    {
        $builder->setFields(
            [
                'adapter' => [
                    'value'    => $builder->getOption('adapter'),
                    'disabled' => 'edit',
                    'config'   => [
                        'options' => function (ExtensionCollection $extensions) {

                            $extensions = $extensions->search('anomaly.module.files::storage_adapter.*');

                            return $extensions->lists('name', 'namespace');
                        }
                    ]
                ],
                'name',
                'slug'    => [
                    'disabled' => 'edit'
                ]
            ]
        );
    }
}
