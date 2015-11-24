<?php namespace Anomaly\FilesModule\File\Plugin\Command;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Support\Decorator;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class FindFile
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Plugin\Command
 */
class FindFile implements SelfHandling
{

    /**
     * The file identifier.
     *
     * @var $identifier
     */
    protected $identifier;

    /**
     * Create a new FindFile instance.
     *
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param FileRepositoryInterface $files
     * @return \Anomaly\FilesModule\File\Contract\FileInterface|null
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders, Decorator $decorator)
    {
        if (is_numeric($this->identifier)) {
            return $decorator->decorate($files->find($this->identifier));
        }

        if (is_string($this->identifier)) {

            list($folder, $name) = explode('/', $this->identifier);

            if (!$folder = $folders->findBySlug($folder)) {
                return null;
            }

            return $decorator->decorate($files->findByName($name, $folder));
        }

        return null;
    }
}
