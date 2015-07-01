<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FileDownloader
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileDownloader extends FileResponse
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

        $response->headers->set('Content-disposition', 'attachment; filename=\"' . addslashes($file->getName()) . '\"');

        return $response->setContent($this->manager->read($file->diskPath()));
    }

    /**
     * Return the response headers.
     *
     * @param FileInterface $file
     * @return Response
     */
    public function download(FileInterface $file)
    {
        $response = $this->make($file);

        return $response->sendHeaders();
    }
}
