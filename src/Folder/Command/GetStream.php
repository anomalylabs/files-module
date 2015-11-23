<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class GetStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Command
 */
class GetStream implements SelfHandling
{

    /**
     * The file folder instance.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new GetStream instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Anomaly\Streams\Platform\Stream\Contract\StreamInterface|null
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        return $streams->findBySlugAndNamespace($this->folder->getSlug(), 'files');
    }
}
