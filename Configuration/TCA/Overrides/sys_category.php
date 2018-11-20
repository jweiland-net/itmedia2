<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function() {
    $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['itmedia2']);
    if ($extConf['fallbackIconPath']) {
        $fallbackIconPath = $extConf['fallbackIconPath'];
    } else {
        $fallbackIconPath = '/uploads/tx_itmedia2/';
    }

    $tempColumns = [
        'icon' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:jw5124001pforzheim/Resources/Private/Language/locallang_db.xlf:sys_category.icon',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => $fallbackIconPath,
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
                'size' => 5,
                'maxitems' => 1,
                'minitems' => 0,
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
            ]
        ]
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', $tempColumns);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'icon', '1', 'after:description');
});
