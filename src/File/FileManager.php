<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Adapter\Command\MoveFile;
use Illuminate\Filesystem\FilesystemManager;

/**
 * Class FileManager
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FileManager
{

    /**
     * The mount manager.
     *
     * @var FilesystemManager
     */
    protected $manager;

    /**
     * Create a new FileManager instance.
     *
     * @param FilesystemManager $manager
     */
    public function __construct(FilesystemManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Move a file.
     *
     * @return bool
     */
    public function move($from, $to)
    {
        list($from_disk, $from_path) = explode('://', $from, 2);
        list($to_disk, $to_path) = explode('://', $to, 2);

        $stream = $this->manager->disk($from_disk)->readStream($from_path);
        $result = $this->manager->disk($to_disk)->writeStream($to_path, $stream);

        if ($result && $this->manager->disk($to_disk)->fileExists($to_path)) {
            $result = dispatch_sync(new MoveFile($from, $to));
        }

        $this->manager->disk($from_disk)->delete($from_path);

        return $result;
    }
}
