<?php namespace Anomaly\FilesModule\Adapter;

use Anomaly\FilesModule\Adapter\Contract\DiskLoaderInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class AdapterExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter
 */
abstract class AdapterExtension extends Extension
{

    /**
     * Return a new disk loader instance.
     *
     * @return DiskLoaderInterface
     */
    public function newLoader()
    {
        $loader = substr(get_class($this), 0, -9) . 'Loader';

        return app()->make($loader, ['extension' => $this]);
    }
}
