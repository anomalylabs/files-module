<?php namespace Anomaly\FilesModule\Http\Controller;

use Anomaly\FilesModule\File\FileDownloader;
use Anomaly\FilesModule\File\FileLocator;
use Anomaly\FilesModule\File\FileReader;
use Anomaly\FilesModule\File\FileStreamer;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class FilesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Http\Controller
 */
class FilesController extends PublicController
{

    public function read(FileLocator $locator, FileReader $reader, $disk, $path)
    {
        if (!$file = $locator->locate($disk, $path)) {
            abort(404);
        }

        return $reader->read($file);
    }

    public function stream(FileLocator $locator, FileStreamer $streamer, $disk, $path)
    {
        if (!$file = $locator->locate($disk, $path)) {
            abort(404);
        }

        return $streamer->stream($file);
    }

    public function download(FileLocator $locator, FileDownloader $downloader, $disk, $path)
    {
        if (!$file = $locator->locate($disk, $path)) {
            abort(404);
        }

        return $downloader->download($file);
    }
}
