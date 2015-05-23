<?php namespace Anomaly\FilesModule\Disk\Contract;

use Anomaly\FilesModule\Adapter\StorageAdapterExtension;

/**
 * Interface DiskInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Contract
 */
interface DiskInterface
{

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the adapter.
     *
     * @return StorageAdapterExtension
     */
    public function getAdapter();
}
