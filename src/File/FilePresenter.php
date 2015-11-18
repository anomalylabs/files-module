<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Image\Image;
use Illuminate\Contracts\Config\Repository;
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
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The image utility.
     *
     * @var Image
     */
    protected $image;

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
     * @param Image        $image
     * @param Request      $request
     * @param Repository   $config
     * @param              $object
     */
    public function __construct(UrlGenerator $url, Image $image, Request $request, Repository $config, $object)
    {
        $this->url     = $url;
        $this->image   = $image;
        $this->config  = $config;
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
     * Return a thumbnail of the file.
     *
     * @param int $width
     * @param int $height
     * @return string
     */
    public function thumbnail($width = 48, $height = 48)
    {
        return $this->object->image()->fit($width, $height)->class('img-rounded');
    }

    /**
     * Return a file preview.
     *
     * @param int $width
     * @param int $height
     * @return string
     */
    public function preview($width = 48, $height = 48)
    {
        if (in_array($this->object->getExtension(), $this->config->get('anomaly.module.files::mimes.thumbnails'))) {
            return $this->thumbnail($width, $height);
        }

        foreach ($this->config->get('anomaly.module.files::mimes.types') as $type => $extensions) {
            if (in_array($this->object->getExtension(), $extensions)) {
                return $this->image
                    ->make('anomaly.module.files::img/types/' . $type . '.png')
                    ->style('margin-left: 6px;')
                    ->height($height)
                    ->image();
            }
        }

        return $this->image
            ->make('anomaly.module.files::img/types/document.png')
            ->style('margin-left: 5px;')
            ->height($height)
            ->image();
    }
}
