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
        'folder'
    ];

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
     * Return the file resource.
     *
     * @return File
     */
    public function resource()
    {
        $disk   = $this->getDisk();
        $folder = $this->getFolder();

        $path = $disk->getSlug() . '://' . $folder->getSlug() . '/' . $this->getFilename();

        /* @var MountManager $manager */
        $manager = app('League\Flysystem\MountManager');

        return $manager->get($path);
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

        $path = $disk->getSlug() . '://' . $folder->getSlug() . '/' . $this->getFilename();

        /* @var Image $image */
        $image = app('Anomaly\Streams\Platform\Image\Image');

        return $image->make($path)->setOutput('image');
    }

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the filename.
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
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
