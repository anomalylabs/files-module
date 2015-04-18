<?php namespace Anomaly\FilesModule;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Command\SaveFile;
use Illuminate\Foundation\Bus\DispatchesCommands;
use League\Flysystem\AdapterInterface;
use League\Flysystem\FileExistsException;
use League\Flysystem\Filesystem;

/**
 * Class FilesFilesystem
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesFilesystem extends Filesystem
{

    use DispatchesCommands;

    /**
     * The disk interface.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new FilesFilesystem instance.
     *
     * @param DiskInterface    $disk
     * @param AdapterInterface $adapter
     * @param null             $config
     */
    public function __construct(DiskInterface $disk, AdapterInterface $adapter, $config = null)
    {
        $this->disk = $disk;

        parent::__construct($adapter, $config);
    }

    /**
     * Create a file or update if exists.
     *
     * @param string $path     path to file
     * @param string $contents file contents
     * @param mixed  $config
     * @throws FileExistsException
     * @return bool
     */
    public function put($path, $contents, array $config = [])
    {
        $result = parent::put($path, $contents, $config);

        $this->dispatch(new SaveFile($this->get($path), $this));

        return $result;
    }

    /**
     * Get the disk.
     *
     * @return DiskInterface
     */
    public function getDisk()
    {
        return $this->disk;
    }
}
