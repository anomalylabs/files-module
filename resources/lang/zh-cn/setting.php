<?php

$post = str_replace('M', '', ini_get('post_max_size'));
$file = str_replace('M', '', ini_get('upload_max_filesize'));

$system = $file > $post ? $post : $file;

return [
    'max_upload_size'      => [
        'name'         => '最大上传大小',
        'instructions' => '指定最大的上传文件大小.',
        'warning'      => '当前服务器允许的最大文件大小为 ' . $system . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => '同时上传最大进程数量',
        'instructions' => '指定最大的同时上传文件数量.',
    ],
];
