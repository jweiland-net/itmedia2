<?php
namespace JWeiland\Itmedia2\Domain\Model;

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

/**
 * Domain model for Category
 * As TYPO3 does not deliverSQL nor TCA for that property the
 * icon-property may be removed in later TYPO3 versions.
 * So please keep it.
 */
class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category
{
    /**
     * Icon
     *
     * @var string
     */
    protected $icon;

    /**
     * Returns the icon
     *
     * @return string $icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the icon
     *
     * @param string $icon
     * @return void
     */
    public function setIcon($icon)
    {
        $this->icon = (string) $icon;
    }
}
