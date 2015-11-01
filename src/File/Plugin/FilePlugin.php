<?php namespace Anomaly\FilesModule\File\Plugin;

use Anomaly\FilesModule\File\Plugin\Command\GetFile;
use Anomaly\FilesModule\File\Plugin\Command\GetFiles;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class FilePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Plugin
 */
class FilePlugin extends Plugin
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
                'file',
                function ($path) {
                    return $this->dispatch(new GetFile($path));
                }
            ),
            new \Twig_SimpleFunction(
                'files',
                function ($path) {
                    return $this->dispatch(new GetFiles($path));
                }
            )
        ];
    }
}
