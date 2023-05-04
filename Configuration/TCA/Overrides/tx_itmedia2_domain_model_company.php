<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Add tx_maps2_uid column to company table
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('maps2')) {
    \JWeiland\Maps2\Tca\Maps2Registry::getInstance()->add(
        'itmedia2',
        'tx_itmedia2_domain_model_company',
        [
            'addressColumns' => ['street', 'house_number', 'zip', 'city'],
            'defaultCountry' => 'Deutschland',
            'defaultStoragePid' => [
                'extKey' => 'itmedia2',
                'property' => 'poiCollectionPid'
            ],
            'synchronizeColumns' => [
                [
                    'foreignColumnName' => 'company',
                    'poiCollectionColumnName' => 'title'
                ]
            ]
        ]
    );
}
