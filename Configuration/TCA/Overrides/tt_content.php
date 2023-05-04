<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['itmedia2_directory'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'itmedia2_directory',
    'FILE:EXT:itmedia2/Configuration/FlexForms/ItMedia.xml'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Itmedia2',
    'Directory',
    'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:plugin.title'
);
