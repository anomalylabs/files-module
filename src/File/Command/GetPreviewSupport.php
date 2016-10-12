<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Illuminate\Contracts\Config\Repository;

/**
 * Class GetPreviewSupport
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetPreviewSupport
{

    /**
     * The file instance.
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * Create a new GetPreviewSupport instance.
     *
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the command.
     *
     * @param  Repository $config
     * @return int|null|string
     */
    public function handle(Repository $config)
    {
        foreach ($config->get('anomaly.module.files::mimes.thumbnails') as $extension) {
            if ($this->file->getExtension() == $extension) {
                return true;
            }
        }

        return null;
    }
}
