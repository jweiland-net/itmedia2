<?php
declare(strict_types=1);
namespace JWeiland\Itmedia2\Configuration;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\SingletonInterface;

/**
 * Get configuration from ExtensionManager
 */
class ExtConf implements SingletonInterface
{
    /**
     * @var string
     */
    protected $fallbackIconPath = '';

    /**
     * @var string
     */
    protected $emailFromAddress = '';

    /**
     * @var string
     */
    protected $emailFromName = '';

    /**
     * @var string
     */
    protected $emailToAddress = '';

    /**
     * @var string
     */
    protected $emailToName = '';

    public function __construct()
    {
        // get global configuration
        $extConf = unserialize(
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['itmedia2'],
            ['allowed_classes' => false]
        );
        if (is_array($extConf) && count($extConf)) {
            // call setter method foreach configuration entry
            foreach ($extConf as $key => $value) {
                $methodName = 'set' . ucfirst($key);
                if (method_exists($this, $methodName)) {
                    $this->$methodName($value);
                }
            }
        }
    }

    /**
     * @return string
     */
    public function getFallbackIconPath(): string
    {
        if (!$this->fallbackIconPath) {
            $this->fallbackIconPath = '/uploads/tx_itmedia2/';
        }
        return $this->fallbackIconPath;
    }

    /**
     * @param string $fallbackIconPath
     */
    public function setFallbackIconPath(string $fallbackIconPath)
    {
        $this->fallbackIconPath = $fallbackIconPath;
    }

    /**
     * @throws \Exception
     * @return string
     */
    public function getEmailFromAddress(): string
    {
        if (empty($this->emailFromAddress)) {
            $senderMail = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'];
            if (empty($senderMail)) {
                throw new \Exception('You have forgotten to set a sender email address in extension configuration or in install tool');
            }
            return $senderMail;
        }
        return $this->emailFromAddress;
    }

    /**
     * @param string $emailFromAddress
     */
    public function setEmailFromAddress(string $emailFromAddress)
    {
        $this->emailFromAddress = $emailFromAddress;
    }

    /**
     * @throws \Exception
     * @return string
     */
    public function getEmailFromName(): string
    {
        if (empty($this->emailFromName)) {
            $senderName = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName'];
            if (empty($senderName)) {
                throw new \Exception('You have forgotten to set a sender name in extension configuration or in install tool');
            }
            return $senderName;
        }
        return $this->emailFromName;
    }

    /**
     * @param string $emailFromName
     */
    public function setEmailFromName(string $emailFromName)
    {
        $this->emailFromName = $emailFromName;
    }

    /**
     * @return string
     */
    public function getEmailToAddress(): string
    {
        return $this->emailToAddress;
    }

    /**
     * @param string $emailToAddress
     */
    public function setEmailToAddress(string $emailToAddress)
    {
        $this->emailToAddress = $emailToAddress;
    }

    /**
     * @return string
     */
    public function getEmailToName(): string
    {
        return $this->emailToName;
    }

    /**
     * @param string $emailToName
     */
    public function setEmailToName(string $emailToName)
    {
        $this->emailToName = $emailToName;
    }
}
