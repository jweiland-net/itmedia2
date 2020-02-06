<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'IT and Media Directory',
    'description' => 'With this extension you can build your own industry directory for IT and Media',
    'category' => 'plugin',
    'author' => 'Markus Kugler',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '2.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
            'maps2' => '7.1.3-7.99.99',
            'yellowpages2' => '3.0.0-3.99.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
