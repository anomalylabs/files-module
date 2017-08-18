<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Command\GetImage;
use Anomaly\FilesModule\File\Command\GetPreviewSupport;
use Anomaly\FilesModule\File\Command\GetResource;
use Anomaly\FilesModule\File\Command\GetType;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\Model\Files\FilesFilesEntryModel;
use League\Flysystem\File;
use League\Flysystem\FilesystemInterface;

/**
 * Class FileModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FileModel extends FilesFilesEntryModel implements FileInterface
{

    /**
     * Always eager load these.
     *
     * @var array
     */
    protected $with = [
        'disk',
        'folder',
        'entry',
    ];

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'entry',
    ];

    /**
     * Return the filesystem URL.
     *
     * @return null|string
     */
    public function url()
    {
        if (!$filesystem = $this->filesystem()) {
            return null;
        }

        return $filesystem->url($this->path());
    }

    /**
     * Return the resource filesystem.
     *
     * @return null|AdapterFilesystem|FilesystemInterface
     */
    public function filesystem()
    {
        if (!$resource = $this->resource()) {
            return null;
        }

        return $resource->getFilesystem();
    }

    /**
     * Return the file resource.
     *
     * @return null|File
     */
    public function resource()
    {
        return $this->dispatch(new GetResource($this));
    }

    /**
     * Return the file path.
     *
     * @return string
     */
    public function path()
    {
        if (!$folder = $this->getFolder()) {
            return null;
        }

        return "{$folder->getSlug()}/{$this->getName()}";
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
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Alias for image()
     *
     * @return Image
     */
    public function make()
    {
        return $this->image();
    }

    /**
     * Return a new image instance.
     *
     * @return Image
     */
    public function image()
    {
        return $this->dispatch(new GetImage($this));
    }

    /**
     * Return the file type.
     *
     * @return string
     */
    public function type()
    {
        return $this->dispatch(new GetType($this));
    }

    /**
     * Return if the image can
     * be previewed or not.
     *
     * @return boolean
     */
    public function canPreview()
    {
        return $this->dispatch(new GetPreviewSupport($this));
    }

    /**
     * Return the file's primary mime type.
     *
     * @return string
     */
    public function primaryMimeType()
    {
        $mimes = explode('/', $this->getMimeType());

        return array_shift($mimes);
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
     * Return the file's sub mime type.
     *
     * @return string
     */
    public function secondaryMimeType()
    {
        $mimes = explode('/', $this->getMimeType());

        return array_pop($mimes);
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
     * Get the width.
     *
     * @return null|int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get the height.
     *
     * @return null|int
     */
    public function getHeight()
    {
        return $this->height;
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
     * Lowercase the extension.
     *
     * @param $value
     */
    public function setExtensionAttribute($value)
    {
        $this->attributes['extension'] = strtolower($value);
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
     * Get the related entry ID.
     *
     * @return null|int
     */
    public function getEntryId()
    {
        return $this->entry_id;
    }

    /**
     * Return the entry as a routable array.
     *
     * @return array
     */
    public function toRoutableArray()
    {
        $array = self::toArray();

        $folder = $this->getFolder();

        $array['folder'] = $folder->getSlug();

        return $array;
    }

    /**
     * Return the entry as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        if ($entry = $this->getEntry()) {
            $array = array_merge($entry->toArray(), $array);
        }

        $array['path']     = $this->path();
        $array['location'] = $this->location();

        return $array;
    }

    /**
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Return the file location.
     *
     * @return string
     */
    public function location()
    {
        if (!$disk = $this->getDisk()) {
            return null;
        }

        return "{$disk->getSlug()}://{$this->path()}";
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
     * Return the searchable array.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = parent::toSearchableArray();

        if ($entry = $this->getEntry()) {
            $array = array_merge($entry->toSearchableArray(), $array);
        }

        return $array;
    }
}
