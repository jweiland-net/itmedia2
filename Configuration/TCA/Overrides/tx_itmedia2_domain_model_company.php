<?php
call_user_func(function() {
    // Add tx_maps2_uid column to company table
    $result = \JWeiland\Maps2\Tca\Maps2Registry::getInstance()->add(
        'itmedia2',
        'tx_itmedia2_domain_model_company'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
        'itmedia2',
        'tx_itmedia2_domain_model_company',
        'main_trade',
        [
            'label' => 'LLL:EXT:yellowpages2/Resources/Private/Language/locallang_db.xlf:tx_yellowpages2_domain_model_company.mainTrade',
            'fieldConfiguration' => [
                'minitems' => 0,
                'maxitems' => 1,
                'eval' => 'required'
            ]
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
        'itmedia2',
        'tx_itmedia2_domain_model_company',
        'trades',
        [
            'label' => 'LLL:EXT:yellowpages2/Resources/Private/Language/locallang_db.xlf:tx_yellowpages2_domain_model_company.trades',
            'fieldConfiguration' => [
                'minitems' => 0,
                'maxitems' => 2
            ]
        ]
    );
});
