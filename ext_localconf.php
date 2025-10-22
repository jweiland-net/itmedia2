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
    );
});
