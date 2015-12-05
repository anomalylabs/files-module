<?php namespace Anomaly\FilesModule\File;

use Anomaly\Streams\Platform\Entry\EntryCriteria;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class FileCriteria
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\File
 */
class FileCriteria extends EntryCriteria
{

    /**
     * Find a file.
     *
     * @param       $identifier
     * @param array $columns
     * @return \Anomaly\Streams\Platform\Entry\EntryPresenter
     */
    public function find($identifier, array $columns = ['*'])
    {
        if (!is_numeric($identifier)) {

            list($folder, $name) = explode('/', $identifier);

            $this->query
                ->join('files_folders', 'files_folders.id', '=', 'files_files.folder_id')
                ->where('files_folders.slug', $folder)
                ->where('files_files.name', $name);

            return (new Decorator())->decorate($this->first($columns));
        }

        return parent::find($identifier, $columns);
    }
}
