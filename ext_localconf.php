<?php

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3')) {
    die('Access denied.');
}

use JWeiland\Itmedia2\Controller\CompanyController;
use JWeiland\Itmedia2\Updater\Itmedia2SlugUpdater;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(function () {
    ExtensionUtility::configurePlugin(
        'Itmedia2',
        'Directory',
        [
            CompanyController::class => 'list, show, search',
        ],
        // non-cacheable actions
        [
            CompanyController::class => 'search',
        ],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['itmedia2UpdateSlug']
        = Itmedia2SlugUpdater::class;

    // Add ItMedia plugin to new element wizard
    ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:itmedia2/Configuration/TSconfig/ContentElementWizard.tsconfig">',
    );
});
