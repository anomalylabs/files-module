<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

/**
 * Class FilePresenter
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FilePresenter extends EntryPresenter
{

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var FileInterface
     */
    protected $object;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new FilePresenter instance.
     *
     * @param UrlGenerator $url
     * @param Request      $request
     * @param              $object
     */
    public function __construct(UrlGenerator $url, Request $request, $object)
    {
        $this->url     = $url;
        $this->request = $request;

        parent::__construct($object);
    }

    /**
     * Return the size in a readable format.
     *
     * @param int $decimals
     * @return string
     */
    public function readableSize($decimals = 2)
    {
        $size = [' B', ' KB', ' MB', ' GB'];

        $factor = floor((strlen($bytes = $this->object->getSize()) - 1) / 3);

        return (float)sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[(int)$factor];
    }

    /**
     * Return the view link.
     *
     * @return string
     */
    public function viewLink()
    {
        return app('html')->link($this->object->publicPath(), $this->object->getName(), ['target' => '_blank']);
    }

    /**
     * Return the URL for the file.
     *
     * @param array $attributes
     * @param null  $secure
     * @return string
     */
    public function url(array $attributes = [], $secure = null)
    {
        if ($secure === null) {
            $secure = $this->request->isSecure();
        }

        return $this->url->to($this->object->publicPath(), $attributes, $secure);
    }
}
