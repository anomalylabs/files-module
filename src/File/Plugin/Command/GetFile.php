<?php namespace Anomaly\FilesModule\File\Plugin\Command;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class GetFile
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Plugin\Command
 */
class GetFile implements SelfHandling
{

    /**
     * The file path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new GetFile instance.
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
     * @param FileRepositoryInterface $files
     * @return \Anomaly\FilesModule\File\Contract\FileInterface|null
     */
    public function handle(FileRepositoryInterface $files)
    {
        return $files->findByPath($this->path);
    }
}
