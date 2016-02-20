<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\MountManager;

/**
 * Class DeleteDirectory
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\Folder\Command
 */
class DeleteDirectory implements SelfHandling
{

    /**
     * The folder interface.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new DeleteDirectory instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     *
     * @param MountManager $manager
     */
    public function handle(MountManager $manager)
    {
        if (!$disk = $this->folder->getDisk()) {
            return;
        }

        $manager->deleteDir($disk->getSlug() . '://' . $this->folder->getSlug());
    }
}
