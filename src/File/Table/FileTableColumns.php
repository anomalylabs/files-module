<?php namespace Anomaly\FilesModule\File\Table;

use Anomaly\FilesModule\File\Contract\FileInterface;

/**
 * Class FileTableColumns
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FilesModule\File\Table
 */
class FileTableColumns
{

    /**
     * Handle the columns.
     *
     * @param FileTableBuilder $builder
     */
    public function handle(FileTableBuilder $builder)
    {
        $builder->setColumns(
            [
                'entry.preview' => [
                    'heading' => 'anomaly.module.files::field.preview.name'
                ],
                'name'          => [
                    'sort_column' => 'name',
                    'wrapper'     => '
                    <strong>{value.file}</strong>
                    <br>
                    <small>{value.disk}://{value.folder}/{value.file}</small>
                    <br>
                    <span>{value.size} {value.keywords}</span>',
                    'value'       => [
                        'file'     => 'entry.name',
                        'folder'   => 'entry.folder.slug',
                        'keywords' => 'entry.keywords.labels',
                        'disk'     => 'entry.folder.disk.slug',
                        'size'     => function (FileInterface $entry) {
                            if (!in_array($entry->getExtension(), config('anomaly.module.files::mimes.thumbnails'))) {
                                return null;
                            }

                            return '<span class="label label-info">' . $entry->getWidth() . ' x ' . $entry->getHeight(
                            ) . '</span>';
                        }
                    ]
                ],
                'size'          => [
                    'sort_column' => 'size',
                    'value'       => 'entry.readable_size'
                ],
                'mime_type',
                'folder'
            ]
        );
    }
}
