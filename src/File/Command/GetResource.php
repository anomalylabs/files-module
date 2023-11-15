<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Illuminate\Filesystem\FilesystemManager;

/**
 * Class GetResource
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetResource
{

    /**
     * The file instance.
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * Create a new GetResource instance.
     *
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * @param FilesystemManager $manager
     * @return boolean|null
     */
    public function handle(FilesystemManager $manager)
    {
        try {
            return $manager->disk($this->file->getDiskSlug())->fileExists($this->file->path());
        } catch (\Exception $e) {
            return null;
        }
    }
}
