<?php namespace Anomaly\FilesModule\Drive\Ui\Form\Handler;

/**
 * Class FieldsHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Ui\Form\Handler
 */
class FieldsHandler
{

    /**
     * Return the form fields.
     *
     * @return array
     */
    public function handle()
    {
        return [
            'name',
            'slug',
            'adapter'
        ];
    }
}
