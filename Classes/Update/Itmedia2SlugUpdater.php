<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Update;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Updater to fill empty slug columns of company records
 */
#[UpgradeWizard('itmedia2_itmedia2SlugUpdate')]
class Itmedia2SlugUpdate implements UpgradeWizardInterface
{
    protected string $tableName = 'tx_itmedia2_domain_model_company';

    protected string $fieldName = 'path_segment';

    protected SlugHelper $slugHelper;

    /**
     * Return the identifier for this wizard
     * This should be the same string as used in the ext_localconf class registration
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return 'itmedia2UpdateSlug';
    }

    public function getTitle(): string
    {
        return '[itmedia2] Update Slug of company records';
    }

    public function getDescription(): string
    {
        return 'Update empty slug column "path_segment" of company records with an URI compatible version of the company name';
    }

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($this->tableName);
        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $amountOfRecordsWithEmptySlug = $queryBuilder
            ->count('*')
            ->from($this->tableName)->where($queryBuilder->expr()->or($queryBuilder->expr()->eq(
                $this->fieldName,
                $queryBuilder->createNamedParameter('', Connection::PARAM_STR),
            ), $queryBuilder->expr()->isNull(
                $this->fieldName,
            )))->executeQuery()
            ->fetchOne();

        return (bool)$amountOfRecordsWithEmptySlug;
    }

    /**
     * Performs the accordant updates.
     *
     * @return bool Whether everything went smoothly or not
     */
    public function executeUpdate(): bool
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($this->tableName);
        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $statement = $queryBuilder
            ->select('uid', 'pid', 'company')
            ->from($this->tableName)->where($queryBuilder->expr()->or($queryBuilder->expr()->eq(
                $this->fieldName,
                $queryBuilder->createNamedParameter('', Connection::PARAM_STR),
            ), $queryBuilder->expr()->isNull(
                $this->fieldName,
            )))->executeQuery();

        $connection = $this->getConnectionPool()->getConnectionForTable($this->tableName);
        while ($recordToUpdate = $statement->fetch()) {
            if ((string)$recordToUpdate['company'] !== '') {
                $slug = $this->getSlugHelper()->generate($recordToUpdate, (int)$recordToUpdate['pid']);
                $connection->update(
                    $this->tableName,
                    [
                        $this->fieldName => $slug,
                    ],
                    [
                        'uid' => (int)$recordToUpdate['uid'],
                    ],
                );
            }
        }

        return true;
    }

    protected function getSlugHelper(): SlugHelper
    {
        if ($this->slugHelper === null) {
            // Add uid to slug, to prevent duplicates
            $config = $GLOBALS['TCA'][$this->tableName]['columns']['path_segment']['config'];
            $config['generatorOptions']['fields'] = ['company', 'uid'];

            $this->slugHelper = GeneralUtility::makeInstance(
                SlugHelper::class,
                $this->tableName,
                $this->fieldName,
                $config,
            );
        }

        return $this->slugHelper;
    }

    /**
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
