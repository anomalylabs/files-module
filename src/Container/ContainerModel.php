<?php namespace Anomaly\FilesModule\Container;

use Anomaly\FilesModule\Container\Contract\ContainerInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
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

    /**
     * Get the title key.
     *
     * @return string
     */
    public function getTitleName()
    {
        // TODO: Implement getTitleName() method.
    }

    /**
     * Get related translations.
     *
     * @return EloquentCollection
     */
    public function getTranslations()
    {
        // TODO: Implement getTranslations() method.
    }

    /**
     * Get a specified relationship.
     *
     * @param  string $relation
     * @return mixed
     */
    public function getRelation($relation)
    {
        // TODO: Implement getRelation() method.
    }

    /**
     * Return whether an entry is deletable or not.
     *
     * @return bool
     */
    public function isDeletable()
    {
        // TODO: Implement isDeletable() method.
    }

    /**
     * Return the object's ETag fingerprint.
     *
     * @return string
     */
    public function etag()
    {
        // TODO: Implement etag() method.
    }

    /**
     * Get the entry attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.
    }

    /**
     * Flush the entry model's cache.
     *
     * @return EntryInterface
     */
    public function flushCache()
    {
        // TODO: Implement flushCache() method.
    }
}
