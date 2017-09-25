<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.' . $_EXTKEY,
    'Directory',
    'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:plugin.title'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'IT and Media');
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_directory'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($_EXTKEY . '_directory', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/YellowPages.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_itmedia2_domain_model_company', 'EXT:itmedia2/Resources/Private/Language/locallang_csh_tx_itmedia2_domain_model_company.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_itmedia2_domain_model_company');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_itmedia2_domain_model_district', 'EXT:itmedia2/Resources/Private/Language/locallang_csh_tx_itmedia2_domain_model_district.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_itmedia2_domain_model_district');

$extConf = unserialize($_EXTCONF);
$tsConfig = 'ext.itmedia2.pid = ' . (int) $extConf['poiCollectionPid'];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($tsConfig);
