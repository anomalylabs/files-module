<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Illuminate\Filesystem\FilesystemManager;

/**
 * Class CreateDirectory
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CreateDirectory
{

    /**
     * The folder interface.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new CreateDirectory instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     */
    public function handle(FilesystemManager $manager)
    {
        if (!$disk = $this->folder->getDisk()) {
            return;
        }

        if ($manager->disk($disk->getSlug())->directoryExists($this->folder->getSlug())) {
            return;
        }

        $manager->disk($disk->getSlug())->createDirectory($this->folder->getSlug());
    }
}
