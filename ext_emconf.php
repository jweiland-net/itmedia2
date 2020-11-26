<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'IT and Media Directory',
    'description' => 'With this extension you can build your own industry directory for IT and Media',
    'category' => 'plugin',
    'author' => 'Markus Kugler',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'version' => '3.0.3',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.20-10.4.99',
            'glossary2' => '4.1.0-4.99.99',
            'yellowpages2' => '4.0.0-4.99.99'
        ],
        'conflicts' => [],
        'suggests' => [
            'maps2' => '8.0.0-0.0.0'
        ]
    ]
];
