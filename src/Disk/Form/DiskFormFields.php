<?php namespace Anomaly\FilesModule\Disk\Form;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class DiskFormFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Form
 */
class DiskFormFields
{

    /**
     * Handle the fields.
     *
     * @param DiskFormBuilder $builder
     */
    public function handle(DiskFormBuilder $builder)
    {
        $fields = [
            'adapter' => [
                'value'    => $builder->getOption('adapter'),
                'disabled' => 'edit',
                'config'   => [
                    'options' => function (ExtensionCollection $extensions) {

                        $extensions = $extensions->search('anomaly.module.files::adapter.*');

                        return $extensions->lists('name', 'namespace');
                    }
                ]
            ],
            'name',
            'slug'    => [
                'disabled' => 'edit'
            ]
        ];

        $builder->setFields($fields);
    }
}
