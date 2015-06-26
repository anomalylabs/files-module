<?php namespace Anomaly\FilesModule\Uploader\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class UploaderFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Uploader\Form
 */
class UploaderFormBuilder extends FormBuilder
{

    /**
     * This is an ajax form.
     *
     * @var bool
     */
    protected $ajax = true;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'files' => [
            'type' => 'anomaly.field_type.files'
        ]
    ];

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'done' => [
            'icon'     => 'check',
            'button'   => 'success',
            'redirect' => '{url.previous}',
            'text'     => 'anomaly.module.files::button.finished'
        ]
    ];

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $buttons = [];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'success_message' => false,
        'title'           => 'anomaly.module.files::admin.upload_files'
    ];

}
