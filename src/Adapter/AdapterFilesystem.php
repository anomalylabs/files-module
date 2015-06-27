<?php namespace Anomaly\FilesModule\Adapter;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Command\SyncFile;
use Illuminate\Foundation\Bus\DispatchesCommands;
use League\Flysystem\AdapterInterface;
use League\Flysystem\FileExistsException;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;

/**
 * Class AdapterFilesystem
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class AdapterFilesystem extends Filesystem implements FilesystemInterface
{

    use DispatchesCommands;

    /**
     * The disk interface.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new AdapterFilesystem instance.
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
     * @param string $path     path to file
     * @param string $contents file contents
     * @param mixed  $config
     * @throws FileExistsException
     * @return bool
     */
    public function put($path, $contents, array $config = [])
    {
        $result = parent::put($path, $contents, $config);

        if ($result && $file = $this->get($path)) {
            $this->dispatch(new SyncFile($this->get($path), $this));
        }

        return $result;
    }

    /**
     * @param string $path     path to file
     * @param string $contents file contents
     * @param mixed  $config
     * @throws FileExistsException
     * @return bool
     */
    public function putStream($path, $resource, array $config = [])
    {
        $result = parent::putStream($path, $resource, $config);

        if ($result && $file = $this->get($path)) {
            $this->dispatch(new SyncFile($this->get($path), $this));
        }

        return $result;
    }

    /**
     * Prepend to a file.
     *
     * @param  string $path
     * @param  string $data
     * @return int
     */
    //public function prepend($path, $data);

    /**
     * Append to a file.
     *
     * @param  string $path
     * @param  string $data
     * @return int
     */
    //public function append($path, $data);

    /**
     * Delete the file at a given path.
     *
     * @param  string|array $paths
     * @return bool
     */
    //public function delete($paths);

    /**
     * Copy a file to a new location.
     *
     * @param  string $from
     * @param  string $to
     * @return bool
     */
    //public function copy($from, $to);

    /**
     * Move a file to a new location.
     *
     * @param  string $from
     * @param  string $to
     * @return bool
     */
    //public function move($from, $to);

    /**
     * Create a directory.
     *
     * @param  string $path
     * @return bool
     */
    //public function makeDirectory($path);

    /**
     * Recursively delete a directory.
     *
     * @param  string $directory
     * @return bool
     */
    //public function deleteDirectory($directory);

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
