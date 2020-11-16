<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * The model to visualize a floor for a company
 */
class Floor extends AbstractEntity
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var int
     */
    protected $sorting = 0;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getSorting(): int
    {
        return $this->sorting;
    }

    /**
     * @param int $sorting
     */
    public function setSorting(int $sorting)
    {
        $this->sorting = $sorting;
    }
}
