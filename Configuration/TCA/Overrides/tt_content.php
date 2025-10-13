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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['itmedia2_directory'] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    'itmedia2_directory',
    'FILE:EXT:itmedia2/Configuration/FlexForms/ItMedia.xml',
);

ExtensionUtility::registerPlugin(
    'Itmedia2',
    'Directory',
    'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:plugin.title',
);
