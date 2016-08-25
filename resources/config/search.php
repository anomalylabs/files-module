<?php

return [
    \Anomaly\FilesModule\File\FileModel::class => [
        'title'       => 'name',
        'keywords'    => 'keywords',
        'description' => 'description',
        'edit_path'   => 'admin/files/edit/{entry.id}',
        'view_path'   => 'files/{entry.path}',
    ],
];
