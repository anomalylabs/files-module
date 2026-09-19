<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allowed Types
    |--------------------------------------------------------------------------
    |
    | Extensions the uploader accepts and the file routes serve inline. Anything
    | absent is refused on upload, and delivered as an attachment if it is
    | already stored. A folder's own allowed types narrow this list rather than
    | widening it, so publish this config to accept anything not listed here.
    |
    | Formats that execute in the browser under this application's origin are
    | deliberately absent: html, htm, xhtml, shtml, xml, js, css, php, phar,
    | jar, exe and swf.
    |
    | SVG is listed, and is not inert - it is a document that can carry script.
    | It is accepted unsanitised because sanitising it reliably means an
    | allow-list large enough to keep Illustrator and Figma exports intact, and
    | a partial one silently strips styling rather than failing. The control is
    | at delivery instead: FileResponse sends every SVG with a Content-Security-
    | Policy of "default-src 'none'; style-src 'unsafe-inline'; sandbox", which
    | denies script in the SVG's own browsing context, and script never runs
    | when an SVG is used as an <img> source. Remove svg here if that trade is
    | not wanted.
    |
    */
    'allowed'    => [
        'jpg',
        'jpeg',
        'jpe',
        'png',
        'gif',
        'bmp',
        'webp',
        'tiff',
        'tif',
        'ico',
        'svg',
        'pdf',
        'doc',
        'docx',
        'xls',
        'xlsx',
        'xlsm',
        'ppt',
        'pptx',
        'odt',
        'ods',
        'odp',
        'pages',
        'numbers',
        'rtf',
        'txt',
        'csv',
        'ics',
        'zip',
        '7z',
        'tar',
        'tgz',
        'gz',
        'mp3',
        'mpga',
        'mp2',
        'wav',
        'ogg',
        'm4a',
        'flac',
        'mp4',
        'mpeg',
        'mpg',
        'mpe',
        'mov',
        'qt',
        'avi',
        'webm',
        'ogv',
        'flv',
        'woff',
        'woff2',
        'ttf',
        'otf',
        'eot',
        'psd',
        'ai',
        'eps',
    ],

    'thumbnails' => [
        'jpeg',
        'jpg',
        'png',
        'svg',
    ],
    'types'      => [
        'archive'      => [
            '7z',
            'zip',
            'tar',
            'tgz',
        ],
        'audio'        => [
            'mpga',
            'mp2',
            'mp3',
            'ra',
            'rv',
            'wav',
        ],
        'calendar'     => [
            'ics',
        ],
        'code'         => [
            'html',
            'js',
            'css',
            'php',
            'xml',
            'json',
        ],
        'data'         => [
            'csv',
        ],
        'database'     => [
            'sql',
            'spf',
        ],
        'document'     => [
            'doc',
            'docx',
            'word',
            'pages',
            'numbers',
        ],
        'font'         => [
            'eot',
            'ttf',
            'otf',
            'woff',
        ],
        'illustrator'  => [
            'ai',
            'eps',
        ],
        'image'        => [
            'bmp',
            'gif',
            'jpeg',
            'jpg',
            'jpe',
            'png',
            'svg',
            'tiff',
            'tif',
            'ico',
            'webp',
        ],
        'pdf'          => [
            'pdf',
        ],
        'photoshop'    => [
            'psd',
        ],
        'presentation' => [
            'ppt',
        ],
        'spreadsheet'  => [
            'xls',
            'xlsx',
            'xlsm',
        ],
        'text'         => [
            'txt',
            'rtf',
        ],
        'video'        => [
            'mpeg',
            'mpg',
            'mpe',
            'mp4',
            'flv',
            'qt',
            'mov',
            'avi',
            'movie',
            'ogv',
            'webm',
        ],
    ],
];
