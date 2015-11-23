<?php namespace Anomaly\FilesModule\Folder\Plugin\Command;

use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\FilesModule\Folder\FolderPresenter;
use Anomaly\Streams\Platform\Support\Decorator;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class FindFolder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder\Plugin\Command
 */
class FindFolder implements SelfHandling
{

    /**
     * The folder identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new FindFolder instance.
     *
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     * @param Decorator                 $decorator
     * @return null|FolderPresenter
     */
    public function handle(FolderRepositoryInterface $folders, Decorator $decorator)
    {
        if (is_numeric($this->identifier)) {
            return $decorator->decorate($folders->find($this->identifier));
        }

        if (is_string($this->identifier)) {
            return $decorator->decorate($folders->findBySlug($this->identifier));
        }

        return null;
    }
}
