<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

/**
 * Class FileResponse
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileResponse
{

    /**
     * The mount manager.
     *
     * @var FilesystemManager
     */
    protected $manager;

    /**
     * The response factory
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new FileResponse
     *
     * @param ResponseFactory $response
     * @param FilesystemManager    $manager
     */
    public function __construct(ResponseFactory $response, FilesystemManager $manager)
    {
        $this->manager  = $manager;
        $this->response = $response;
    }

    /**
     * Make the response.
     *
     * @param  FileInterface $file
     * @return Response
     */
    public function make(FileInterface $file)
    {
        /* @var Response $response */
        $response = $this->response->make();

        $response->headers->set('Etag', $file->etag());
        $response->headers->set('Content-Type', $file->getMimetype());
        $response->headers->set('Last-Modified', $file->lastModified()->setTimezone('GMT')->format('D, d M Y H:i:s'));

        $response->setTtl(3600);

        return $response;
    }
}
