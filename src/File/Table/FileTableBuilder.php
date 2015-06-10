<?php namespace Anomaly\FilesModule\File\Table;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FileTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Table
 */
class FileTableBuilder extends TableBuilder
{

    /**
     * The disk instance.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * The folder instance.
     *
     * @var FolderInterface
     */
    protected $folder;

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

        // Limit results to the desired folder if any.
        if ($folder = $this->getFolder()) {
            $query->where('folder_id', $folder->getId());
        } else {
            $query->where('folder_id', null);
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
     * Get the folder.
     *
     * @return FolderInterface
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set the folder.
     *
     * @param FolderInterface $folder
     * @return $this
     */
    public function setFolder(FolderInterface $folder)
    {
        $this->folder = $folder;

        return $this;
    }
}
