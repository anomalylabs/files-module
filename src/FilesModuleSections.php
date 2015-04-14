<?php namespace Anomaly\FilesModule;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;

/**
 * Class FilesModuleSections
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModuleSections
{

    use DispatchesCommands;

    /**
     * Handle the module sections.
     *
     * @param ControlPanelBuilder $builder
     */
    public function handle(ControlPanelBuilder $builder, Request $request)
    {
        $segments = $request->segments();

        array_shift($segments);
        array_shift($segments);
        array_shift($segments);

        $drive  = array_shift($segments);
        $folder = array_pop($segments);

        $builder->setSections(
            [
                'browser' => [
                    'buttons' => [
                        'upload' => [
                            'button'     => 'success',
                            'icon'       => 'upload',
                            'text'       => 'module::button.upload',
                            'disabled'   => function () use ($request) {
                                return $request->segment(3) !== 'browser';
                            },
                            'attributes' => [
                                'data-toggle' => 'uploader'
                            ]
                        ],
                        [
                            'button'   => 'new_folder',
                            'href'     => 'admin/files/folders/create/' . $drive . '/' . $folder,
                            'disabled' => function () use ($request) {
                                return $request->segment(3) !== 'browser';
                            }
                        ]
                    ]
                ],
                'drives'  => [
                    'buttons' => [
                        'new_drive'
                    ]
                ],
                'settings'
            ]
        );
    }
}
