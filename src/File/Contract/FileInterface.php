<?php namespace Anomaly\FilesModule\File\Contract;

/**
 * Interface FileInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Contract
 */
interface FileInterface
{

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();
}
