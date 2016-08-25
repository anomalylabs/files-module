<?php

$post = str_replace('M', '', ini_get('post_max_size'));
$file = str_replace('M', '', ini_get('upload_max_filesize'));

$system = $file > $post ? $post : $file;

return [
    'max_upload_size'      => [
        'name'         => '上傳檔案大小限制',
        'instructions' => '請指定上傳檔案大小的最大限制。',
        'warning'      => '您的伺服器目前最大的上傳限制是 ' . $system . 'MB。',
    ],
    'max_parallel_uploads' => [
        'name'         => '同時上傳數量限制',
        'instructions' => '請指定同時間可以上傳檔案的最多數量。',
    ],
];
