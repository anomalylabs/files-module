<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\FileModel;
use Anomaly\FilesModule\File\FileSanitizer;
use Illuminate\Filesystem\FilesystemManager;


/**
 * Class DeleteResource
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteResource
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
     */
    public function handle(FilesystemManager $manager)
    {
        if (!$this->file->isForceDeleting()) {
            return;
        }

        if (!$this->file->getFolder())
        {
            return;
        }

        if (!FileModel::withTrashed()
            ->where('name', FileSanitizer::clean($this->file->getName()))
            ->where('folder_id', $this->file->getFolder()->getId())
            ->first()) {
            return;
        }

        if (!$this->file->resource()) {
            return;
        }

        /**
         * Delete resource
         */
        $manager->disk($this->file->getDiskSlug())->delete($this->file->path());
    }
}
