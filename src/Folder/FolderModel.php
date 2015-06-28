<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\FileCollection;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\Files\FilesFoldersEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class FolderModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder
 */
class FolderModel extends FilesFoldersEntryModel implements FolderInterface
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
        'parent'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        self::observe('Anomaly\FilesModule\Folder\FolderObserver');
    }

    /**
     * Return the folder's path.
     *
     * @param null $path
     * @return string
     */
    public function path($path = null)
    {
        $path = $this->getName() . ($path ? '/' . $path : $path);

        if ($parent = $this->getParent()) {
            return $parent->path($path);
        }

        return $path;
    }

    /**
     * Return the folders's path on it's disk.
     *
     * @param null $path
     * @return string
     */
    public function diskPath($path = null)
    {
        if ($parent = $this->getParent()) {
            return $parent->diskPath($this->getName() . ($path ? '/' . $path : $path));
        }

        $disk = $this->getDisk();

        return $disk->path($this->getName() . ($path ? '/' . $path : $path));
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
     * Get related files.
     *
     * @return FileCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Get the related parent folder.
     *
     * @return null|FolderInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get related folders.
     *
     * @return FolderCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Return the files relation.
     *
     * @return HasMany
     */
    public function files()
    {
        return $this->hasMany('Anomaly\FilesModule\File\FileModel', 'folder_id');
    }

    /**
     * Return the folder relation.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany('Anomaly\FilesModule\Folder\FolderModel', 'parent_id');
    }
}
