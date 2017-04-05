<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'JWeiland.' . $_EXTKEY,
    'Directory',
    array(
        'Company' => 'list, show, search',
    ),
    // non-cacheable actions
    array(
        'Company' => 'search',
    )
);

// use hook to automatically add a map record to current yellow page
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'JWeiland\\Itmedia2\\Tca\\CreateMap';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['JWeiland\\Itmedia2\\Tasks\\Update'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'Update itmedia2',
    'description'      => 'Hide all itmedia2 records which are older than the specified age.'
);
