<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_itmedia2_domain_model_company',
    'EXT:itmedia2/Resources/Private/Language/locallang_csh_tx_itmedia2_domain_model_company.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_itmedia2_domain_model_district',
    'EXT:itmedia2/Resources/Private/Language/locallang_csh_tx_itmedia2_domain_model_district.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_itmedia2_domain_model_company');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_itmedia2_domain_model_district');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_itmedia2_domain_model_floor');
