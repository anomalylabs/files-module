<?php namespace Anomaly\FilesModule\Adapter;

use Anomaly\FilesModule\Adapter\Command\DeleteFile;
use Anomaly\FilesModule\Adapter\Command\DeleteFolder;
use Anomaly\FilesModule\Adapter\Command\SyncFile;
use Anomaly\FilesModule\Adapter\Command\SyncFolder;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Foundation\Bus\DispatchesCommands;
use InvalidArgumentException;
use League\Flysystem\AdapterInterface;
use League\Flysystem\FileExistsException;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\RootViolationException;

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
     * Write a new file.
     *
     * @param string $path     The path of the new file.
     * @param string $contents The file contents.
     * @param array  $config   An optional configuration array.
     *
     * @throws FileExistsException
     *
     * @return bool True on success, false on failure.
     */
    public function write($path, $contents, array $config = [])
    {
        $result = parent::write($path, $contents, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource, $this));
        }

        return $result;
    }

    /**
     * Write a new file using a stream.
     *
     * @param string   $path     The path of the new file.
     * @param resource $resource The file handle.
     * @param array    $config   An optional configuration array.
     *
     * @throws InvalidArgumentException If $resource is not a file handle.
     * @throws FileExistsException
     *
     * @return bool True on success, false on failure.
     */
    public function writeStream($path, $resource, array $config = [])
    {
        $result = parent::writeStream($path, $resource, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource, $this));
        }

        return $result;
    }

    /**
     * Update an existing file.
     *
     * @param string $path     The path of the existing file.
     * @param string $contents The file contents.
     * @param array  $config   An optional configuration array.
     *
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function update($path, $contents, array $config = [])
    {
        $result = parent::update($path, $contents, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource, $this));
        }

        return $result;
    }

    /**
     * Update an existing file using a stream.
     *
     * @param string   $path     The path of the existing file.
     * @param resource $resource The file handle.
     * @param array    $config   An optional configuration array.
     *
     * @throws InvalidArgumentException If $resource is not a file handle.
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function updateStream($path, $resource, array $config = [])
    {
        $result = parent::updateStream($path, $resource, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource, $this));
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
    public function put($path, $contents, array $config = [])
    {
        $result = parent::put($path, $contents, $config);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource, $this));
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

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new SyncFile($resource, $this));
        }

        return $result;
    }

    /**
     * Copy a file.
     *
     * @param string $path    Path to the existing file.
     * @param string $newpath The new path of the file.
     *
     * @throws FileExistsException   Thrown if $newpath exists.
     * @throws FileNotFoundException Thrown if $path does not exist.
     *
     * @return bool True on success, false on failure.
     */
    public function copy($path, $newpath)
    {
        $result = parent::copy($path, $newpath);

        if ($result && $resource = $this->get($newpath)) {
            return $this->dispatch(
                new SyncFile($resource, $this)
            ); // TODO: $newpath could be for a new filesystem (not $this).
        }

        return $result;
    }

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function delete($path)
    {
        $result = parent::delete($path);

        if ($result && $resource = $this->get($path)) {
            return $this->dispatch(new DeleteFile($resource, $this));
        }

        return $result;
    }

    /**
     * Delete a directory.
     *
     * @param string $dirname
     *
     * @throws RootViolationException Thrown if $dirname is empty.
     *
     * @return bool True on success, false on failure.
     */
    public function deleteDir($dirname)
    {
        $result = parent::deleteDir($dirname);

        if ($result && $resource = $this->get($dirname)) {
            return $this->dispatch(new DeleteFolder($resource, $this));
        }

        return $result;
    }

    /**
     * Create a directory.
     *
     * @param string $dirname The name of the new directory.
     * @param array  $config  An optional configuration array.
     *
     * @return bool True on success, false on failure.
     */
    public function createDir($dirname, array $config = [])
    {
        $result = parent::createDir($dirname, $config);

        if ($result && $resource = $this->get($dirname)) {
            return $this->dispatch(new SyncFolder($resource, $this));
        }

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