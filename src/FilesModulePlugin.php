<?php namespace Anomaly\FilesModule;

use Anomaly\FilesModule\File\Command\GetFile;
use Anomaly\FilesModule\File\Command\GetMaxUploadSize;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Decorator;
use Twig\TwigFunction;

/**
 * Class FilesModulePlugin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
            new TwigFunction(
                'max_upload_size',
                function () {
                    return dispatch_sync(new GetMaxUploadSize());
                }
            ),
            new TwigFunction(
                'file',
                function ($identifier) {
                    return (new Decorator())->decorate(dispatch_sync(new GetFile($identifier)));
                }
            ),
            new TwigFunction(
                'folder',
                function ($identifier) {
                    return (new Decorator())->decorate(dispatch_sync(new GetFolder($identifier)));
                }
            ),
        ];
    }
}
