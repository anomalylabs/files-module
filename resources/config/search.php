<?php

return [
    \Anomaly\FilesModule\File\FileModel::class => [
        'title'       => 'filename',
        'keywords'    => 'keywords',
        'description' => null,
        //'view_path'   => 'entry.path',
        'edit_path'   => 'admin/files/edit/{entry.id}'
    ]
];
