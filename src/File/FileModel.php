<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\Model\Files\FilesFilesEntryModel;
use Carbon\Carbon;
use League\Flysystem\File;
use League\Flysystem\MountManager;

/**
 * Class FileModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileModel extends FilesFilesEntryModel implements FileInterface
{

    /**
     * Cache results.
     *
     * @var int
     */
    protected $cacheMinutes = 99999;

    /**
     * Always eager load these relations.
     *
     * @var array
     */
    protected $with = [
        'disk',
        'folder'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        self::observe('Anomaly\FilesModule\File\FileObserver');
    }

    /**
     * Return a hash of the file.
     *
     * @return string
     */
    public function hash()
    {
        return md5(json_encode($this->getAttributes()));
    }

    /**
     * Return the type of the file.
     *
     * @return string
     */
    public function type()
    {
        $parts = explode('/', $this->getMimeType());

        return array_shift($parts);
    }

    /**
     * Return the file's path.
     *
     * @return string
     */
    public function path()
    {
        if ($folder = $this->getFolder()) {
            return $folder->path($this->getName());
        }

        return $this->getName();
    }

    /**
     * Return the file's path on it's disk.
     *
     * @return string
     */
    public function diskPath()
    {
        $disk = $this->getDisk();

        if ($folder = $this->getFolder()) {
            return $disk->path($folder->path($this->getName()));
        }

        return $disk->path($this->getName());
    }

    /**
     * Return the file's public path.
     *
     * @return string
     */
    public function publicPath()
    {
        $disk = $this->getDisk();
        $path = $this->path();

        return 'files/get/' . $disk->getSlug() . '/' . $path;
    }

    /**
     * Return the file's image path.
     *
     * @param array $parameters
     * @return string
     */
    public function imagePath(array $parameters = [])
    {
        $disk = $this->getDisk();
        $path = $this->path();

        $query = http_build_query(
            array_map(
                function ($value) {
                    return implode(',', (array)$value);
                },
                $parameters
            ),
            '',
            '&amp;'
        );

        return 'files/image/' . $disk->getSlug() . '/' . $path . ($query ? '?' . $query : null);
    }

    /**
     * Return the file's stream path.
     *
     * @return string
     */
    public function streamPath()
    {
        $disk = $this->getDisk();
        $path = $this->path();

        return 'files/stream/' . $disk->getSlug() . '/' . $path;
    }

    /**
     * Return the file's download path.
     *
     * @return string
     */
    public function downloadPath()
    {
        $disk = $this->getDisk();
        $path = $this->path();

        return 'files/download/' . $disk->getSlug() . '/' . $path;
    }

    /**
     * Return the file resource.
     *
     * @return File
     */
    public function resource()
    {
        $disk = $this->getDisk();

        /* @var MountManager $manager */
        $manager = app('League\Flysystem\MountManager');

        if (!$manager->has($disk->path($this->path()))) {
            return null;
        }

        return $manager->get($disk->path($this->path()));
    }

    /**
     * Return a new image instance.
     *
     * @return Image
     */
    public function image()
    {
        /* @var Image $image */
        $image = app('Anomaly\Streams\Platform\Image\Image');

        return $image->make($this->diskPath())->setOutput('image');
    }

    /**
     * Return the last modified datetime.
     *
     * @return Carbon
     */
    public function lastModified()
    {
        return $this->last_modified ?: $this->created_at;
    }

    /**
     * Get the alt attribute.
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the related disk.
     *
     * @return DiskInterface
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * Get the size.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the related folder.
     *
     * @return null|FolderInterface
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Get the mime type.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mime_type;
    }

    /**
     * Get the extension.
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Get the keywords.
     *
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Return the public path by default.
     *
     * @return string
     */
    function __toString()
    {
        return $this->publicPath();
    }
}
