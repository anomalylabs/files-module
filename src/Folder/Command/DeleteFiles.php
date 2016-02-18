<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class DeleteFiles
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\Folder\Command
 */
class DeleteFiles implements SelfHandling
{

    /**
     * The folder interface.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new DeleteFiles instance.
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
     * @param FileRepositoryInterface $files
     */
    public function handle(FileRepositoryInterface $files)
    {
        foreach ($this->folder->getFiles() as $file) {
            $files->delete($file);
        }
    }
}
