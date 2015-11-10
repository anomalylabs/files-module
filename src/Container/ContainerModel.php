<?php namespace Anomaly\FilesModule\Container;

use Anomaly\FilesModule\Container\Contract\ContainerInterface;
use Anomaly\Streams\Platform\Model\Files\FilesContainersEntryModel;

/**
 * Class ContainerModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Container
 */
class ContainerModel extends FilesContainersEntryModel implements ContainerInterface
{

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        self::observe(app(substr(__CLASS__, 0, -5) . 'Observer'));

        parent::boot();
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        dd($this->titleName);

        return $this->name;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
