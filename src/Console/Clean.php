<?php namespace Anomaly\FilesModule\Console;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Clean
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class Clean extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'files:clean';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Clean missing files from the files table.';

    /**
     * Handle the command.
     *
     * @param FileRepositoryInterface $files
     */
    public function handle(FileRepositoryInterface $files)
    {
        $missing = false;

        /* @var FileInterface|EloquentModel $file */
        foreach ($files->all() as $file) {

            if (!$file->resource()) {

                $missing = true;

                if (!$this->option('pretend')) {
                    $files->delete($file);
                }

                $this->info($file->path() . ' ' . (!$this->option('pretend') ? 'deleted' : 'missing') . '.');
            }
        }

        if (!$missing) {
            $this->info('Files database is clean.');
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['pretend', null, InputOption::VALUE_NONE, 'Perform a dry run without deleting.'],
        ];
    }
}
