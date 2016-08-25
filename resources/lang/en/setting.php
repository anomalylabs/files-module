<?php

$post = str_replace('M', '', ini_get('post_max_size'));
$file = str_replace('M', '', ini_get('upload_max_filesize'));

$system = $file > $post ? $post : $file;

return [
    'max_upload_size'      => [
        'name'         => 'Maximum Upload Size',
        'instructions' => 'Specify the maximum file size for uploads.',
        'warning'      => 'Your server\'s max upload size is currently ' . $system . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Maximum Parallel Uploads',
        'instructions' => 'Specify the maximum number of files that can be uploaded at the same time.',
    ],
];
