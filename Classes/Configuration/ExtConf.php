<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Configuration;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Get configuration from ExtensionManager
 */
class ExtConf implements SingletonInterface
{
    protected int $poiCollectionPid = 0;

    public function __construct()
    {
        // get global configuration
        $extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('itmedia2');
        if (is_array($extConf)) {
            // call setter method foreach configuration entry
            foreach ($extConf as $key => $value) {
                $methodName = 'set' . ucfirst($key);
                if (method_exists($this, $methodName)) {
                    $this->$methodName($value);
                }
            }
        }
    }

    public function getPoiCollectionPid(): int
    {
        return $this->poiCollectionPid;
    }

    public function setPoiCollectionPid($poiCollectionPid)
    {
        $this->poiCollectionPid = (int)$poiCollectionPid;
    }
}
