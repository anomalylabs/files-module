<?php

$post = str_replace('M', '', ini_get('post_max_size'));
$file = str_replace('M', '', ini_get('upload_max_filesize'));

$system = $file > $post ? $post : $file;

return [
    'max_upload_size'      => [
        'name'         => 'Maximale Upload Größe',
        'instructions' => 'Geben Sie die maximale Dateigröße für Uploads an.',
        'warning'      => 'Die maximale Upload Größe Ihres Servers beträgt gerade ' . $system . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Maximale Parallele Uploads',
        'instructions' => 'Geben Sie die maximale Anzahl Dateien an, die zur gleichen Zeit hochgeladen werden können.',
    ],
];
