<?php namespace Anomaly\FilesModule\Disk\Command;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class GetDiskEntriesStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Command
 */
class GetDiskEntriesStream implements SelfHandling
{

    /**
     * The disk instance.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new GetDiskEntriesStream instance.
     *
     * @param DiskInterface $disk
     */
    public function __construct(DiskInterface $disk)
    {
        $this->disk = $disk;
    }

    /**
     * Handle the command.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Anomaly\Streams\Platform\Stream\Contract\StreamInterface|null
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        return $streams->findBySlugAndNamespace($this->disk->getSlug(), 'files');
    }
}
