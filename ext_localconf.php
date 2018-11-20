<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'JWeiland.itmedia2',
    'Directory',
    [
        'Company' => 'list, show, search'
    ],
    // non-cacheable actions
    [
        'Company' => 'search'
    ]
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\JWeiland\Itmedia2\Tasks\Update::class] = [
    'extension'        => 'itmedia2',
    'title'            => 'Update itmedia2',
    'description'      => 'Hide all itmedia2 records which are older than the specified age.'
];
