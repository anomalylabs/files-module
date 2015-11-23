<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class DeleteStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Command
 */
class DeleteStream implements SelfHandling
{

    /**
     * The file folder instance.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new DeleteStream instance.
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
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        $streams->delete($streams->findBySlugAndNamespace($this->folder->getSlug() . '_files', 'files'));
    }
}
