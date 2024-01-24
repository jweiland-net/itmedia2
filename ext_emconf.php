<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'IT and Media Directory',
    'description' => 'With this extension you can build your own industry directory for IT and Media',
    'category' => 'plugin',
    'author' => 'Stefan Froemken',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'version' => '3.2.1',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.36-11.5.99',
            'glossary2' => '5.0.0-0.0.0',
            'yellowpages2' => '4.0.0-0.0.0',
        ],
        'conflicts' => [],
        'suggests' => [
            'maps2' => '8.0.0-0.0.0',
        ],
    ],
];
