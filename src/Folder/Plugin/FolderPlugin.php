<?php namespace Anomaly\FilesModule\Folder\Plugin;

use Anomaly\FilesModule\Folder\Plugin\Command\FindFolder;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class FolderPlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Plugin
 */
class FolderPlugin extends Plugin
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
                'folder',
                function ($identifier) {
                    return $this->dispatch(new FindFolder($identifier));
                }
            )
        ];
    }
}
