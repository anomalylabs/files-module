<?php

$post = str_replace('M', '', ini_get('post_max_size'));
$file = str_replace('M', '', ini_get('upload_max_filesize'));

$system = $file > $post ? $post : $file;

return [
    'max_upload_size'      => [
        'name'         => 'Taille maximale d\'envoi',
        'instructions' => 'Choisissez la taille maximale des fichiers envoyés.',
        'warning'      => 'La taille maximale autorisée par votre serveur est : ' . $system . ' Mo',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Nombre d\'envois simultanés',
        'instructions' => 'Choisissez le nombre maximum d\'envoi possible en même temps.',
    ],
];
