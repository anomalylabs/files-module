<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Illuminate\Routing\ResponseFactory;
use League\Flysystem\MountManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FileResponse
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileResponse
{

    /**
     * @var MountManager
     */
    protected $manager;

    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new FileResponse
     *
     * @param ResponseFactory $response
     * @param MountManager    $manager
     */
    public function __construct(ResponseFactory $response, MountManager $manager)
    {
        $this->manager  = $manager;
        $this->response = $response;
    }

    /**
     * Make the response.
     *
     * @param FileInterface $file
     * @return Response
     */
    public function make(FileInterface $file)
    {
        // Start the response.
        $response = $this->response->make();

        $response->headers->set('Etag', $file->etag());
        $response->headers->set('Content-Type', $file->getMimetype());
        $response->headers->set('Last-Modified', $file->lastModified()->setTimezone('GMT')->format('D, d M Y H:i:s'));

        $response->setTtl(3600);

        return $response;
    }
}
