<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\File\FileCollection;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\Files\FilesFoldersEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class FolderModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Folder
 */
class FolderModel extends FilesFoldersEntryModel implements FolderInterface
{

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Get related files.
     *
     * @return FileCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Return related files.
     *
     * @return HasMany
     */
    public function files()
    {
        return $this->hasMany('Anomaly\FilesModule\File\FileModel', 'folder_id');
    }
}
