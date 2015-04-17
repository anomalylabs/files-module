<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\Files\FilesFoldersEntryModel;

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
     * Return the folder's path.
     *
     * @param null $path
     * @return string
     */
    public function path($path = null)
    {
        $path = $this->getSlug() . ($path ? '/' . $path : $path);

        if ($parent = $this->getParent()) {
            return $parent->path($path);
        }

        return $path;
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
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the related parent.
     *
     * @return FolderInterface
     */
    public function getParent()
    {
        return $this->parent;
    }
}
