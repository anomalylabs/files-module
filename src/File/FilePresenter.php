<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Image\Image;
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
     * @param              $object
     */
    public function __construct(UrlGenerator $url, Image $image, Request $request, $object)
    {
        $this->url     = $url;
        $this->image   = $image;
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
     * @return string
     */
    public function preview()
    {
        if ($this->object->type() == 'image') {
            if (!str_contains($this->object->getMimeType(), 'photoshop')) {
                return $this->thumbnail(48, 48);
            }else {
                return $this->image->make('anomaly.module.files::img/photoshop.png')->style('margin-left: 5px;')->height(48)->image();
            }
        }

        if ($this->object->getExtension() == 'pdf') {
            return $this->image->make('anomaly.module.files::img/pdf.png')->style('margin-left: 5px;')->height(48)->image();
        }

        if ($this->object->getExtension() == 'sql') {
            return $this->image->make('anomaly.module.files::img/data.png')->style('margin-left: 5px;')->height(48)->image();
        }

        if ($this->object->getExtension() == 'zip') {
            return $this->image->make('anomaly.module.files::img/archive.png')->style('margin-left: 5px;')->height(48)->image();
        }

        if ($this->object->getExtension() == 'mp3') {
            return $this->image->make('anomaly.module.files::img/audio.png')->style('margin-left: 5px;')->height(48)->image();
        }

        if ($this->object->getExtension() == 'mp4') {
            return $this->image->make('anomaly.module.files::img/video.png')->style('margin-left: 5px;')->height(48)->image();
        }

        if ($this->object->getExtension() == 'psd') {
            return $this->image->make('anomaly.module.files::img/photoshop.png')->style('margin-left: 5px;')->height(48)->image();
        }

        if ($this->object->type() != 'image') {
            return $this->image->make('anomaly.module.files::img/document.png')->style('margin-left: 5px;')->height(48)->image();
        }

        return null;
    }
}
