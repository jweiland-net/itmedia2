<?php

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'IT and Media Directory',
    'description' => 'With this extension you can build your own industry directory for IT and Media',
    'category' => 'plugin',
    'author' => 'Stefan Froemken, Hoja Mustaffa Abdul Latheef',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'version' => '4.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
            'glossary2' => '6.0.0-0.0.0',
            'yellowpages2' => '5.0.0-0.0.0',
        ],
        'conflicts' => [],
        'suggests' => [
            'maps2' => '9.0.0-0.0.0',
        ],
    ],
];
