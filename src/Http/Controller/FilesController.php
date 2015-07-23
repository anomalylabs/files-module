<?php namespace Anomaly\FilesModule\Http\Controller;

use Anomaly\FilesModule\File\FileDownloader;
use Anomaly\FilesModule\File\FileLocator;
use Anomaly\FilesModule\File\FileReader;
use Anomaly\FilesModule\File\FileStreamer;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Intervention\Image\ImageManager;
use League\Flysystem\MountManager;


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

    /**
     * Return a file's contents.
     *
     * @param FileLocator $locator
     * @param FileReader  $reader
     * @param             $disk
     * @param             $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function read(FileLocator $locator, FileReader $reader, $disk, $path)
    {
        if (!$file = $locator->locate($disk, $path)) {
            abort(404);
        }

        return $reader->read($file);
    }

    /**
     * Stream a file's contents.
     *
     * @param FileLocator  $locator
     * @param FileStreamer $streamer
     * @param              $disk
     * @param              $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stream(FileLocator $locator, FileStreamer $streamer, $disk, $path)
    {
        if (!$file = $locator->locate($disk, $path)) {
            abort(404);
        }

        return $streamer->stream($file);
    }

    /**
     * Download a file.
     *
     * @param FileLocator    $locator
     * @param FileDownloader $downloader
     * @param                $disk
     * @param                $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function download(FileLocator $locator, FileDownloader $downloader, $disk, $path)
    {
        if (!$file = $locator->locate($disk, $path)) {
            abort(404);
        }

        return $downloader->download($file);
    }

    /**
     * Return an image's thumbnail.
     *
     * @param FileLocator  $locator
     * @param MountManager $manager
     * @param ImageManager $image
     * @param              $disk
     * @param              $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function image(FileLocator $locator, MountManager $manager, ImageManager $image, $disk, $path)
    {
        if (!$file = $locator->locate($disk, $path)) {
            abort(404);
        }

        return $image->make($manager->read($file->diskPath()))->encode($file->getMimeType())->response(null, $_GET['quality']);
    }
}
