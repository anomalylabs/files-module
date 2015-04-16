<?php namespace Anomaly\FilesModule\Disk\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class DiskFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Form
 */
class DiskFormBuilder extends FormBuilder
{

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => 'module::js/adapter.js|debug'
    ];

}
