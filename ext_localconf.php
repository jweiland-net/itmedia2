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
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'JWeiland\\Yellowpages2light\\Tca\\CreateMap';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['JWeiland\\Yellowpages2light\\Tasks\\Update'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'Update yellowpages',
    'description'      => 'Hide all yellowpages records which are older than the secified age.'
);
