<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\FilesModule\File\FileModel;
use Anomaly\FilesModule\Folder\FolderModel;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\Support\Collection;

class BrowserTableEntries
{

    public function handle(Table $table, FolderModel $folders, FileModel $files)
    {
        $entries = (new Collection($folders->all()))->merge($files->all());

        $table->setEntries($entries);
    }
}
