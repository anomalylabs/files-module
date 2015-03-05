<?php namespace Anomaly\FilesModule\Browser\Table;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;

/**
 * Class BrowserTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule\Browser\Table
 */
class BrowserTableColumns
{

    /**
     * Handle the table columns.
     *
     * @param BrowserTableBuilder $builder
     */
    public function handle(BrowserTableBuilder $builder)
    {
        $builder->setColumns(
            [
                [
                    'value' => function ($entry) {

                        if ($entry instanceof FolderInterface) {
                            return '<i class="fa fa-folder-o"></i>';
                        }

                        if ($entry instanceof FileInterface) {
                            return '<i class="fa fa-file"></i>';
                        }
                    }
                ],
                [
                    'value' => 'entry.name'
                ]
            ]
        );
    }
}
