<?php namespace Anomaly\FilesModule\Folder\Table;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FolderTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FoldersModule\Folder\Table
 */
class FolderTableBuilder extends TableBuilder
{

    /**
     * The disk instance.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * The parent folder instance.
     *
     * @var FolderInterface
     */
    protected $parent;

    /**
     * Fired when the table is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getDisk()) {
            throw new \Exception('The $disk parameter is required.');
        }
    }

    /**
     * Fired just before querying.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $disk = $this->getDisk();

        // Limit results to the desired disk.
        $query->where('disk_id', $disk->getId());

        // Limit results to the desired parent folder if any.
        if ($this->getTableFilters()->active()->isEmpty()) {
            if ($parent = $this->getParent()) {
                $query->where('parent_id', $parent->getId());
            } else {
                $query->where('parent_id', null);
            }
        }
    }

    /**
     * Get the disk.
     *
     * @return DiskInterface
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * Set the disk interface.
     *
     * @param DiskInterface $disk
     * @return $this
     */
    public function setDisk(DiskInterface $disk)
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * Get the parent folder.
     *
     * @return FolderInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent folder.
     *
     * @param FolderInterface $parent
     * @return $this
     */
    public function setParent(FolderInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
