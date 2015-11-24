<?php namespace Anomaly\FilesModule\File\Plugin;

use Anomaly\FilesModule\File\Plugin\Command\FindFile;
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
                function ($identifier) {
                    return $this->dispatch(new FindFile($identifier));
                }
            )
        ];
    }
}
