<?php namespace Anomaly\FilesModule\Disk\Form;

use Anomaly\FilesModule\Adapter\StorageAdapterExtension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class DiskFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Disk\Form
 */
class DiskFormBuilder extends FormBuilder
{

    /**
     * The storage adapter.
     *
     * @var null|StorageAdapterExtension
     */
    protected $adapter = null;

    /**
     * The fields to skip.
     *
     * @var array
     */
    protected $skips = [
        'adapter'
    ];

    /**
     * Fired just before
     * saving the form entry.
     */
    public function onSaving()
    {
        $entry   = $this->getFormEntry();
        $adapter = $this->getAdapter();

        $entry->adapter = $adapter->getNamespace();
    }

    /**
     * Get the adapter.
     *
     * @return StorageAdapterExtension|null
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Set the adapter.
     *
     * @param StorageAdapterExtension $adapter
     * @return $this
     */
    public function setAdapter(StorageAdapterExtension $adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }
}
