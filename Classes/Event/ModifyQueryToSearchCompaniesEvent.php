<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Event;

use TYPO3\CMS\Core\Database\Query\QueryBuilder;

/**
 * Post process controller actions which assign fluid variables to view.
 * Often used by controller actions like "show" or "list". No redirects possible here.
 */
class ModifyQueryToSearchCompaniesEvent
{
    public function __construct(
        protected QueryBuilder $queryBuilder,
        protected string $search,
        protected int $categoryUid,
        protected array $settings,
    ) {}

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    public function setQueryBuilder(QueryBuilder $queryBuilder): void
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getSearch(): string
    {
        return $this->search;
    }

    public function setSearch(string $search): void
    {
        $this->search = $search;
    }

    public function getCategoryUid(): int
    {
        return $this->categoryUid;
    }

    public function setCategoryUid(int $categoryUid): void
    {
        $this->categoryUid = $categoryUid;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function setSettings(array $settings): void
    {
        $this->settings = $settings;
    }
}
