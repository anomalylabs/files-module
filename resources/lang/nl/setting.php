<?php

$post = str_replace('M', '', ini_get('post_max_size'));
$file = str_replace('M', '', ini_get('upload_max_filesize'));

$system = $file > $post ? $post : $file;

return [
    'max_upload_size'      => [
        'name'         => 'Maximale Upload Grootte',
        'instructions' => 'Specificeer de maximale bestandsgrootte voor uploads.',
        'warning'      => 'Je server\'s max upload grootte is nu ' . $system . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Maximale Parallelle Uploads',
        'instructions' => 'Specificeer het maximale aantal bestanden dat tegelijk geüpload kan worden.',
    ],
];
