<?php
declare(strict_types = 1);
namespace JWeiland\Itmedia2\Domain\Model;

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Position of the company at the selected address.
 * For example east or building 1, building 2, ...
 */
class Position extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title = '';

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
