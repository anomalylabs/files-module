<?php namespace Anomaly\FilesModule\Console;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileSynchronizer;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Filesystem\FilesystemManager;
use League\Flysystem\File;

/**
 * Class Sync
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Sync extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'files:sync';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Sync missing files from the filesystem into the database.';

    /**
     * Handle the command.
     *
     * @param FilesystemManager $manager
     * @param FileSynchronizer $synchronizer
     * @param FolderRepositoryInterface $folders
     * @param FileRepositoryInterface $files
     */
    public function handle(
        FilesystemManager $manager,
        FileSynchronizer $synchronizer,
        FolderRepositoryInterface $folders,
        FileRepositoryInterface $files
    ) {
        /* @var FolderInterface $folder */
        foreach ($folders->all() as $folder) {

            $contents = $manager->disk($folder->getDisk()->getSlug())->listContents($folder->getSlug(), false);

            $contents = $contents->filter(function ($file) {
                return $file->type() == 'file';
            });

            $this->info('Checking:' . $folder->path());

            foreach ($contents as $file) {
                if (!$files->findByNameAndFolder(basename($file->path()), $folder)) {

                    $synchronizer->sync($file, $folder->getDisk());

                    $this->info('Synced: ' . $file->path());
                }
            }
        }
    }
}
