<?php namespace Anomaly\FilesModule;

use Anomaly\FilesModule\File\Command\GetMaxUploadSize;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class FilesModulePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModulePlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'max_upload_size',
                function () {
                    return $this->dispatch(new GetMaxUploadSize());
                }
            )
        ];
    }
}
