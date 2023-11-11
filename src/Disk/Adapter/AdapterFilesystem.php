<?php namespace Anomaly\FilesModule\Disk\Adapter;

use Anomaly\FilesModule\Disk\Adapter\Command\DeleteFile;
use Anomaly\FilesModule\Disk\Adapter\Command\DeleteFolder;
use Anomaly\FilesModule\Disk\Adapter\Command\SyncFile;
use Anomaly\FilesModule\Disk\Adapter\Command\SyncFolder;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Support\Collection;
use League\Flysystem\Config;
use League\Flysystem\Directory;
use League\Flysystem\DirectoryAttributes;
use League\Flysystem\DirectoryListing;
use League\Flysystem\File;
use League\Flysystem\FileAttributes;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\Handler;
use League\Flysystem\PathPrefixer;
use League\Flysystem\SymbolicLinkEncountered;
use League\Flysystem\Util;
use function League\Flysystem\path;

/**
 * Class AdapterFilesystem
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AdapterFilesystem
{
    /**
     * The base URL.
     *
     * @var null|string
     */
    protected $baseUrl = null;

    /**
     * The disk interface.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * @var FilesystemAdapter
     */
    protected $adapter;

    /**
     * Create a new AdapterFilesystem instance.
     *
     * @param DiskInterface $disk
     * @param FilesystemAdapter $adapter
     * @param array $config
     */
    public function __construct(DiskInterface $disk, FilesystemAdapter $adapter, $config = [])
    {
        $this->disk = $disk;

        $this->baseUrl = array_get($config, 'base_url');

        $this->adapter = $adapter;
    }

    /**
     * @param string $path
     * @return bool
     * @throws \League\Flysystem\FilesystemException
     */
    public function fileExists(string $path): bool
    {
        return $this->adapter->fileExists($path);
    }

    /**
     * @param string $path
     * @return bool
     * @throws \League\Flysystem\FilesystemException
     */
    public function directoryExists(string $path): bool
    {
        return $this->adapter->directoryExists($path);
    }

    /**
     * @param string $path
     * @param string $contents
     * @param array $config
     * @return mixed
     * @throws \League\Flysystem\FilesystemException
     */
    public function write(string $path, string $contents, $config = [])
    {
        $this->adapter->write($path, $contents, new Config($config));

        $entry = new FileAttributes($path, $this->fileSize($path), null, null, $this->mimeType($path));

        return dispatch_sync(new SyncFile($entry, $this->disk));
    }

    /**
     * @param string $path
     * @param $contents
     * @param array $config
     * @return mixed
     * @throws \League\Flysystem\FilesystemException
     */
    public function writeStream(string $path, $contents, $config = [])
    {
        $this->adapter->writeStream($path, $contents, new Config($config));

        $entry = new FileAttributes($path, $this->fileSize($path), null, null, $this->mimeType($path));

        return dispatch_sync(new SyncFile($entry, $this->disk));
    }

    /**
     * @param string $path
     * @return string
     * @throws \League\Flysystem\FilesystemException
     */
    public function read(string $path): string
    {
        return $this->adapter->read($path);
    }

    /**
     * @param string $path
     * @return resource
     * @throws \League\Flysystem\FilesystemException
     */
    public function readStream(string $path)
    {
        return $this->adapter->readStream($path);
    }

    /**
     * @param string $path
     * @param string $visibility
     * @throws \League\Flysystem\FilesystemException
     */
    public function setVisibility(string $path, string $visibility)
    {
        $this->adapter->setVisibility($path, $visibility);
    }

    /**
     * @param string $path
     * @return FileAttributes
     * @throws \League\Flysystem\FilesystemException
     */
    public function visibility(string $path): FileAttributes
    {
        return $this->adapter->visibility($path);
    }

    /**
     * @param string $path
     * @return string
     * @throws \League\Flysystem\FilesystemException
     */
    public function mimeType(string $path): string
    {
        return $this->adapter->mimeType($path)->mimeType();
    }

    /**
     * @param string $path
     * @return FileAttributes
     * @throws \League\Flysystem\FilesystemException
     */
    public function lastModified(string $path): FileAttributes
    {
        return $this->adapter->lastModified($path);
    }

    /**
     * @param string $path
     * @return int
     * @throws \League\Flysystem\FilesystemException
     */
    public function fileSize(string $path): int
    {
        return $this->adapter->fileSize($path)->fileSize();
    }

    /**
     * @param string $path
     * @param bool $deep
     * @return iterable
     * @throws \League\Flysystem\FilesystemException
     */
    public function listContents(string $path, bool $deep)
    {
        $path = $this->url($path);
        if (!is_dir($path)) {
            return;
        }

        $iterator = $this->listDirectory($path);

        $contents = new Collection();

        foreach ($iterator as $fileInfo) {
            $pathName = $fileInfo->getPathname();

            if ($fileInfo->isLink()) {
                if ($this->linkHandling & self::SKIP_LINKS) {
                    continue;
                }
                throw SymbolicLinkEncountered::atLocation($pathName);
            }

            $prefixer = new PathPrefixer($this->baseUrl, DIRECTORY_SEPARATOR);
            $path = $prefixer->stripPrefix($pathName);

            $lastModified = $fileInfo->getMTime();
            $isDirectory = $fileInfo->isDir();
            $permissions = octdec(substr(sprintf('%o', $fileInfo->getPerms()), -4));

            $item = $isDirectory ? new DirectoryAttributes(str_replace('\\', '/', $path), null, $lastModified) : new FileAttributes(
                str_replace('\\', '/', $path),
                $fileInfo->getSize(),
                null,
                $lastModified,
                $this->mimeType($path)
            );

            $contents->add($item);
        }

        return $contents;
    }

    private function listDirectory(string $location)
    {
        $iterator = new \DirectoryIterator($location);

        foreach ($iterator as $item) {
            if ($item->isDot()) {
                continue;
            }

            yield $item;
        }
    }

    /**
     * @param string $path
     * @throws \League\Flysystem\FilesystemException
     */
    public function delete(string $path)
    {
        $entry = new FileAttributes($path, $this->fileSize($path), null, null, $this->mimeType($path));

        $this->adapter->delete($path);

        dispatch_sync(new DeleteFile($entry));

    }

    /**
     * @param string $path
     * @return mixed
     * @throws \League\Flysystem\FilesystemException
     */
    public function deleteDirectory(string $path)
    {
        $this->adapter->deleteDirectory($path);

        return dispatch_sync(new DeleteFolder($path));
    }

    /**
     * @param string $path
     * @param array $config
     * @return mixed
     * @throws \League\Flysystem\FilesystemException
     */
    public function createDirectory(string $path, $config = [])
    {
        $this->adapter->createDirectory($path, new Config($config));

        return dispatch_sync(new SyncFolder($path, $this->disk));
    }

    /**
     * @param string $source
     * @param string $destination
     * @param array $config
     * @throws \League\Flysystem\FilesystemException
     */
    public function move(string $source, string $destination, $config = [])
    {
        $this->adapter->move($source, $destination, new Config($config));
    }

    /**
     * @param string $source
     * @param string $destination
     * @param array $config
     * @return mixed
     * @throws \League\Flysystem\FilesystemException
     */
    public function copy(string $source, string $destination, $config = [])
    {
        $this->adapter->copy($source, $destination, new Config($config));

        if (is_dir($source)) {
            return dispatch_sync(new SyncFolder($path, $this->disk));
        } else {
            $entry = new FileAttributes($path, $this->fileSize($path), null, null, $this->mimeType($path));
            return dispatch_sync(new SyncFile($entry, $this->disk));
        }
    }

    /**
     * Return the real path to a file.
     *
     * @param $path
     * @return string
     */
    public function url($path)
    {
        return rtrim($this->baseUrl, '/') . '/' . $path;
    }

    /**
     * Get the base URL.
     *
     * @return mixed|null|string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set the base URL.
     *
     * @param $baseUrl
     * @$this
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
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