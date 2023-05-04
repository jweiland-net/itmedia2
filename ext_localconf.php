<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Itmedia2',
        'Directory',
        [
            \JWeiland\Itmedia2\Controller\CompanyController::class => 'list, show, search',
        ],
        // non-cacheable actions
        [
            \JWeiland\Itmedia2\Controller\CompanyController::class => 'search',
        ]
    );

    // Register SVG Icon Identifier
    $svgIcons = [
        'ext-itmedia2-directory-wizard-icon' => 'plugin_wizard.svg',
    ];
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    foreach ($svgIcons as $identifier => $fileName) {
        $iconRegistry->registerIcon(
            $identifier,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:itmedia2/Resources/Public/Icons/' . $fileName]
        );
    }

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['itmedia2UpdateSlug']
        = \JWeiland\Itmedia2\Updater\Itmedia2SlugUpdater::class;

    // Add ItMedia plugin to new element wizard
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:itmedia2/Configuration/TSconfig/ContentElementWizard.txt">'
    );
});
