<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\FileCollection;
use Anomaly\FilesModule\Folder\Command\GetStream;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\Files\FilesFoldersEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\UsersModule\Role\RoleCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class FolderModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the allowed types.
     *
     * @return array
     */
    public function getAllowedTypes()
    {
        return $this->allowed_types;
    }

    /**
     * Set the allowed types attribute.
     *
     * @return array
     */
    public function setAllowedTypesAttribute(array $types)
    {
        $this->setFieldValue('allowed_types', $types);

        return $this->allowed_types = array_map(
            function ($type) {
                return strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $type));
            },
            $this->getAllowedTypes()
        );
    }

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName()
    {
        $stream = $this->getEntryStream();

        return $stream->getEntryModelName();
    }

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream()
    {
        return $this->dispatch(new GetStream($this));
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
     * Return the files relation.
     *
     * @return HasMany
     */
    public function files()
    {
        return $this->hasMany('Anomaly\FilesModule\File\FileModel', 'folder_id');
    }
}
