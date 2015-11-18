<?php

return [
    'files'   => [
        'name'    => 'Files',
        'warning' => 'File permissions are managed in the module\'s <strong>Folders</strong> section.',
        'option'  => [
            'manage' => 'Can access files section?'
        ],
    ],
    'folders' => [
        'name'   => 'Folders',
        'option' => [
            'read'   => 'Can access folders section?',
            'write'  => 'Can create and edit folders?',
            'delete' => 'Can delete folders?'
        ]
    ],
    'disks'   => [
        'name'   => 'Disks',
        'option' => [
            'read'   => 'Can view disks?',
            'write'  => 'Can create and edit disks?',
            'delete' => 'Can delete disks?'
        ]
    ],
    'fields'  => [
        'name'   => 'Fields',
        'option' => [
            'manage' => 'Can manage custom fields?'
        ]
    ]
];

