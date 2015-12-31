<?php namespace Anomaly\FilesModule\Console;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Clean
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Console
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
     * Fire the command.
     *
     * @param FileRepositoryInterface $files
     */
    public function fire(FileRepositoryInterface $files)
    {
        /* @var FileInterface|EloquentModel $file */
        foreach ($files->all() as $file) {
            if (!$file->resource()) {

                if ($this->option('delete')) {
                    $files->delete($file);
                }

                $this->info($file->path() . ' ' . ($this->option('delete') ? 'deleted' : 'missing') . '.');
            }
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
