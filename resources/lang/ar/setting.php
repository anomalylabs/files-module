<?php

$post = str_replace('M', '', ini_get('post_max_size'));
$file = str_replace('M', '', ini_get('upload_max_filesize'));

$system = $file > $post ? $post : $file;

return [
    'max_upload_size'      => [
        'name'         => 'الحجم الأعلى للرفع',
        'instructions' => 'حدد أعلى حجم ممكن للرفع.',
        'warning'      => 'الحجم الأعلى المحدد للرفع على مخدمك: ' . $system . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'الحد الأعلى للرفع المتوازي',
        'instructions' => 'حدد أعلى عدد للمفات يمكن تحميلها بنفس الوقت.',
    ],
];
