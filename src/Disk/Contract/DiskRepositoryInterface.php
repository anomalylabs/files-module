<?php namespace Anomaly\FilesModule\Disk\Contract;

use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Interface DiskRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Contract
 */
interface DiskRepositoryInterface
{

    /**
     * Return all disks.
     *
     * @return EntryCollection
     */
    public function all();

    /**
     * Return the first disk.
     *
     * @return null|DiskInterface
     */
    public function first();

    /**
     * Find a disk by ID.
     *
     * @param $id
     * @return null|DiskInterface
     */
    public function find($id);

    /**
     * Find a disk by slug.
     *
     * @param $slug
     * @return null|DiskInterface
     */
    public function findBySlug($slug);
}
