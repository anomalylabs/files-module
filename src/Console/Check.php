<?php namespace Anomaly\FilesModule\Console;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Check
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Console
 */
class Check extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'files:check';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Check for missing files from the files table.';

    /**
     * Fire the command.
     *
     * @param FileRepositoryInterface $files
     */
    public function fire(FileRepositoryInterface $files)
    {
        $missing = false;

        /* @var FileInterface|EloquentModel $file */
        foreach ($files->all() as $file) {

            if (!$file->resource()) {

                $missing = true;

                if ($this->option('delete')) {
                    $files->delete($file);
                }

                $this->info($file->path() . ' ' . ($this->option('delete') ? 'deleted' : 'missing') . '.');
            }
        }

        if ($missing && !$this->option('delete')) {
            $this->error('Run with the --delete flag to delete missing files.');
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
            ['delete', null, InputOption::VALUE_NONE, 'Delete missing files.']
        ];
    }
}
