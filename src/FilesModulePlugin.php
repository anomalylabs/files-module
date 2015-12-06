<?php namespace Anomaly\FilesModule;

use Anomaly\FilesModule\File\Command\GetMaxUploadSize;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\MarkdownFieldType\Command\GetFile;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Decorator;

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
            ),
            new \Twig_SimpleFunction(
                'file',
                function ($identifier) {
                    return (new Decorator())->decorate($this->dispatch(new GetFile($identifier)));
                }
            ),
            new \Twig_SimpleFunction(
                'folder',
                function ($identifier) {
                    return (new Decorator())->decorate($this->dispatch(new GetFolder($identifier)));
                }
            )
        ];
    }
}
