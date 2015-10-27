<?php namespace Anomaly\FilesModule;

use Illuminate\Http\Request;

/**
 * Class FilesModuleUploadable
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModuleUploadable
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request)
    {
        return !(bool)$request->get('filter_folder');
    }
}
