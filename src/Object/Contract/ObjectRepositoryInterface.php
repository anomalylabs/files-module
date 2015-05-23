<?php namespace Anomaly\FilesModule\Object\Contract;

/**
 * Interface ObjectRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Object\Contract
 */
interface ObjectRepositoryInterface
{

    /**
     * Find an object by it's path.
     *
     * @param $path
     * @return null|ObjectInterface
     */
    public function findByPath($path);
}
