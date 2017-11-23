<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if ($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['itmedia2']['fallbackIconPath']) {
    $fallbackIconPath = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['itmedia2']['fallbackIconPath'];
} else {
    $fallbackIconPath = '/uploads/tx_itmedia2/';
}

$tempColumns = [
    'icon' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:sys_category.icon',
        'config' => [
            'type' => 'group',
            'internal_type' => 'file',
            'uploadfolder' => $fallbackIconPath,
            'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
            'show_thumbs' => true,
            'size' => 5,
            'maxitems' => 1,
            'minitems' => 0
        ]
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'icon', '1', 'after:description');
unset($tempColumns);
