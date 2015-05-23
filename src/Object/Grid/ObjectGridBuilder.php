<?php namespace Anomaly\FilesModule\Object\Grid;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Object\Contract\ObjectInterface;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

/**
 * Class ObjectGridBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Object\Grid
 */
class ObjectGridBuilder extends GridBuilder
{

    /**
     * The disk instance.
     *
     * @var null|DiskInterface
     */
    protected $disk = null;

    /**
     * The parent object.
     *
     * @var null|ObjectInterface
     */
    protected $parent = null;

    /**
     * Get the disk.
     *
     * @return null
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * Set the disk.
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
     * Get the parent.
     *
     * @return ObjectInterface|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent.
     *
     * @param ObjectInterface|null $parent
     * @return $this
     */
    public function setParent(ObjectInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }
}
