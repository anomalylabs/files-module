<?php namespace Anomaly\FilesModule\Drive\Contract;

use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Interface DriveRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Drive\Contract
 */
interface DriveRepositoryInterface
{

    /**
     * Return all drives.
     *
     * @return EntryCollection
     */
    public function all();

    /**
     * Return the first drive.
     *
     * @return null|DriveInterface
     */
    public function first();

    /**
     * Find a drive by slug.
     *
     * @param $slug
     * @return null|DriveInterface
     */
    public function findBySlug($slug);
}
