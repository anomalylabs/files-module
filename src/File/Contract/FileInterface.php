<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;

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
     * Return the file path.
     *
     * @return string
     */
    public function path();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the related folder.
     *
     * @return null|FolderInterface
     */
    public function getFolder();
}
