<?php namespace Anomaly\FilesModule\Adapter;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Http\Request;

/**
 * Class AdapterUrl
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Adapter
 */
class AdapterUrl
{

    /**
     * Generate the URL for this adapter.
     *
     * @param DiskInterface $disk
     * @param Request       $request
     * @return string
     */
    public function generate(DiskInterface $disk, Request $request)
    {
        return url('files/' . $disk->getSlug(), [], $request->isSecure());
    }
}
