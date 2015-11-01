<?php namespace Anomaly\FilesModule\File\Plugin\Command;

use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class GetFiles
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Plugin\Command
 */
class GetFiles implements SelfHandling
{

    /**
     * The folder path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new GetFiles instance.
     *
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     * @return \Anomaly\FilesModule\File\FileCollection
     */
    public function handle(FolderRepositoryInterface $folders)
    {
        $folder = $folders->findBySlug($this->path);

        return $folder->getFiles();
    }
}
