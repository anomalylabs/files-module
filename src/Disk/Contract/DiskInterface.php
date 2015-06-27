<?php namespace Anomaly\FilesModule\Disk\Contract;

use Anomaly\FilesModule\Adapter\AdapterExtension;
use Anomaly\FilesModule\Adapter\AdapterFilesystem;

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
     * Return the disk's path.
     *
     * @param null $path
     * @return string
     */
    public function path($path = null);

    /**
     * Return the disk's filesystem.
     *
     * @return AdapterFilesystem
     */
    public function filesystem();

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
     * @return AdapterExtension
     */
    public function getAdapter();
}
