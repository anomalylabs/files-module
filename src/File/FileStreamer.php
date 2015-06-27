<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FileStreamer
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileStreamer extends FileResponse
{

    /**
     * Make the response.
     *
     * @param FileInterface $file
     * @return Response
     */
    public function make(FileInterface $file)
    {
        $response = parent::make($file);

        $response->headers->set('Content-disposition', 'inline');
        $response->headers->set('Content-Transfer-Encoding', 'binary');
        $response->headers->set('Content-Length', ($file->getSize() - 1));
        $response->headers->set('Accept-Ranges', '0-' . ($file->getSize() - 1));

        $this->chunk($response, $file);

        return $response;
    }

    /**
     * Return the response headers.
     *
     * @param FileInterface $file
     * @return Response
     */
    public function stream(FileInterface $file)
    {
        $response = $this->make($file);

        return $this->response->stream(
            function () use ($file) {
                return $this->manager->readStream($file->diskPath());
            },
            200,
            array_combine(
                array_keys($response->headers->all()),
                array_map(
                    function ($header) {
                        return array_shift($header);
                    },
                    $response->headers->all()
                )
            )
        );
    }

    protected function chunk(Response $response, FileInterface $file)
    {

        $size = $chunkStart = $file->getSize();

        $end = $chunkEnd = $size - 1;

        $response->headers->set('Content-Range', "bytes 0-{$end}/{$size}");

        if (!$range = array_get($_SERVER, 'HTTP_RANGE')) {
            return;
        }

        list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);

        if (strpos($range, ',') !== false) {
            $response->setStatusCode(416, 'Requested Range Not Satisfiable');
            $response->headers->set('Content-Range', "bytes 0-{$end}/{$size}");
        }

        if ($range == '-') {
            $chunkStart = $size - substr($range, 1);
        } else {
            $range      = explode('-', $range);
            $chunkStart = $range[0];
            $chunkEnd   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
        }

        $chunkEnd = ($chunkEnd > $end) ? $end : $chunkEnd;

        if ($chunkStart > $chunkEnd || $chunkStart > $size - 1 || $chunkEnd >= $size) {
            $response->setStatusCode(416, 'Requested Range Not Satisfiable');
            $response->headers->set('Content-Range', "bytes 0-{$end}/{$size}");
        }
    }
}
