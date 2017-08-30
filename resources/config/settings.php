<?php

return [
    'max_upload_size'      => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'default_value' => function () {
                $post = str_replace('M', '', ini_get('post_max_size'));
                $file = str_replace('M', '', ini_get('upload_max_filesize'));

                return $file > $post ? $post : $file;
            },
            'max'           => function () {
                $post = str_replace('M', '', ini_get('post_max_size'));
                $file = str_replace('M', '', ini_get('upload_max_filesize'));

                return $file > $post ? $post : $file;
            },
            'min'           => 1,
        ],
    ],
    'max_parallel_uploads' => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'default_value' => 1,
            'min'           => 1,
        ],
    ],
];
