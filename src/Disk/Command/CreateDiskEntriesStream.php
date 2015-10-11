<?php namespace Anomaly\FilesModule\Disk\Command;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class CreateDiskEntriesStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Command
 */
class CreateDiskEntriesStream implements SelfHandling
{

    /**
     * The disk instance.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new CreateDiskEntriesStream instance.
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
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        $streams->create(
            [
                'namespace'    => 'files',
                'slug'         => $this->disk->getSlug(),
                'translatable' => true
            ]
        );
    }
}
