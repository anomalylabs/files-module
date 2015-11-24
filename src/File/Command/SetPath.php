<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class SetPath
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File\Command
 */
class SetPath implements SelfHandling
{

    /**
     * The file instance.
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * Create a new SetPath instance.
     *
     * @param $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $folder = $this->file->getFolder();

        $this->file->setFieldValue('path', $folder->getSlug() . '/' . $this->file->getName());
    }
}
