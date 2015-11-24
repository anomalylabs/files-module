<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\Model\Files\FilesFilesEntryModel;
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
        'folder.disk'
    ];

    /**
     * Return the file path.
     *
     * @return string
     */
    public function path()
    {
        $folder = $this->getFolder();

        return "{$folder->getSlug()}/{$this->getName()}";
    }

    /**
     * Return the file location.
     *
     * @return string
     */
    public function location()
    {
        $disk = $this->getDisk();

        return "{$disk->getSlug()}://{$this->path()}";
    }

    /**
     * Return the file resource.
     *
     * @return File
     */
    public function resource()
    {
        /* @var MountManager $manager */
        $manager = app('League\Flysystem\MountManager');

        return $manager->get($this->location());
    }

    /**
     * Return a new image instance.
     *
     * @return Image
     */
    public function image()
    {
        $disk   = $this->getDisk();
        $folder = $this->getFolder();

        $path = $disk->getSlug() . '://' . $folder->getSlug() . '/' . $this->getName();

        /* @var Image $image */
        $image = app('Anomaly\Streams\Platform\Image\Image');

        return $image->make($path)->setOutput('image');
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
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
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
     * Return the public path by default.
     *
     * @return string
     */
    function __toString()
    {
        return $this->publicPath();
    }
}
