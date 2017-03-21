<?php namespace Anomaly\FilesModule\Http\Controller;

use Anomaly\FilesModule\File\FileDownloader;
use Anomaly\FilesModule\File\FileImage;
use Anomaly\FilesModule\File\FileLocator;
use Anomaly\FilesModule\File\FileReader;
use Anomaly\FilesModule\File\FileStreamer;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Image\Image;
use Illuminate\Contracts\Config\Repository;


/**
 * Class FilesController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FilesController extends PublicController
{

    /**
     * Return a file's contents.
     *
     * @param  FileLocator                                $locator
     * @param  FileReader                                 $reader
     * @param  Repository                                 $config
     * @param                                             $folder
     * @param                                             $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param $path
     */
    public function read(FileLocator $locator, FileReader $reader, Repository $config, $folder, $name)
    {
        $public = $config->get('anomaly.module.files::folders.public');

        if ($public && !in_array($folder, $public)) {
            abort(404);
        }

        if (!$file = $locator->locate($folder, urldecode($name))) {
            abort(404);
        }

        return $reader->read($file);
    }

    /**
     * Stream a file's contents.
     *
     * @param  FileLocator                                $locator
     * @param  FileStreamer                               $streamer
     * @param  Repository                                 $config
     * @param                                             $folder
     * @param                                             $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param $path
     */
    public function stream(FileLocator $locator, FileStreamer $streamer, Repository $config, $folder, $name)
    {
        $public = $config->get('anomaly.module.files::folders.public');

        if ($public && !in_array($folder, $public)) {
            abort(404);
        }

        if (!$file = $locator->locate($folder, urldecode($name))) {
            abort(404);
        }

        return $streamer->stream($file);
    }

    /**
     * Download a file.
     *
     * @param  FileLocator                                $locator
     * @param  FileDownloader                             $downloader
     * @param  Repository                                 $config
     * @param                                             $folder
     * @param                                             $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param $path
     */
    public function download(FileLocator $locator, FileDownloader $downloader, Repository $config, $folder, $name)
    {
        $public = $config->get('anomaly.module.files::folders.public');

        if ($public && !in_array($folder, $public)) {
            abort(404);
        }

        if (!$file = $locator->locate($folder, urldecode($name))) {
            abort(404);
        }

        return $downloader->download($file);
    }

    /**
     * Return thumbnail image.
     *
     * @param  FileLocator                                $locator
     * @param  FileImage                                  $thumbnail
     * @param  Repository                                 $config
     * @param  Image                                      $image
     * @param                                             $folder
     * @param                                             $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     * @internal param $path
     */
    public function thumbnail(
        FileLocator $locator,
        FileImage $thumbnail,
        Repository $config,
        Image $image,
        $folder,
        $name
    ) {
        $public = $config->get('anomaly.module.files::folders.public');

        if ($public && !in_array($folder, $public)) {
            abort(404);
        }

        if (!$file = $locator->locate($folder, urldecode($name))) {
            abort(404);
        }

        $image = $image->make($file);

        $image->resize(148, 148);

        return $thumbnail->generate($image);
    }
}
