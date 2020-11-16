<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Domain\Repository;

use JWeiland\Itmedia2\Domain\Model\Company;
use TYPO3\CMS\Core\Charset\CharsetConverter;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Repository to get and search for companies
 */
class CompanyRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'company' => QueryInterface::ORDER_ASCENDING
    ];

    /**
     * @var CharsetConverter
     */
    protected $charsetConverter;

    public function injectCharsetConverter(CharsetConverter $charsetConverter)
    {
        $this->charsetConverter = $charsetConverter;
    }

    public function findHiddenEntryByUid(int $companyUid): ?Company
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setEnableFieldsToBeIgnored(['disabled']);

        /** @var Company $company */
        $company = $query->matching($query->equals('uid', (int)$companyUid))->execute()->getFirst();
        return $company;
    }

    /**
     * Find all records starting with given letter
     *
     * @param string $letter
     * @param array $settings
     * @return QueryResultInterface
     */
    public function findByStartingLetter(string $letter, array $settings = []): QueryResultInterface
    {
        $query = $this->createQuery();

        $constraintAnd = [];

        if (!empty($letter)) {
            $constraintOr = [];
            if ($letter == '0-9') {
                $constraintOr[] = $query->like('company', '0%');
                $constraintOr[] = $query->like('company', '1%');
                $constraintOr[] = $query->like('company', '2%');
                $constraintOr[] = $query->like('company', '3%');
                $constraintOr[] = $query->like('company', '4%');
                $constraintOr[] = $query->like('company', '5%');
                $constraintOr[] = $query->like('company', '6%');
                $constraintOr[] = $query->like('company', '7%');
                $constraintOr[] = $query->like('company', '8%');
                $constraintOr[] = $query->like('company', '9%');
            } else {
                $constraintOr[] = $query->like('company', $letter . '%');
            }
            $constraintAnd[] = $query->logicalOr($constraintOr);
        }

        if ($settings['district']) {
            $constraintAnd[] = $query->equals('district', $settings['district']);
        }

        if ($settings['showWspMembers']) {
            $constraintAnd[] = $query->equals('wspMember', $settings['showWspMembers']);
        }

        if (count($constraintAnd)) {
            return $query->matching($query->logicalAnd($constraintAnd))->execute();
        }
        return $query->execute();
    }

    /**
     * Get an array with available starting letters
     *
     * @param bool $isWsp
     * @return array
     */
    public function getStartingLetters(bool $isWsp): array
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable('tx_itmedia2_domain_model_company');
        $queryBuilder
            ->selectLiteral('UPPER(LEFT(company, 1)) as letter')
            ->from('tx_itmedia2_domain_model_company')
            ->add('groupBy', 'letter')
            ->add('orderBy', 'letter');

        if ($isWsp) {
            $queryBuilder->where(
                $queryBuilder->expr()->eq(
                    'wsp_member',
                    $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)
                )
            );
        }

        /** @var Query $query */
        $query = $this->createQuery();
        return $query->statement($queryBuilder)->execute(true);
    }

    public function searchCompanies(string $search, int $category): QueryResultInterface
    {
        /** @var Query $query */
        $query = $this->createQuery();
        // strtolower is not UTF-8 compatible
        // $search = strtolower($search);
        $longStreetSearch = trim($search);
        $smallStreetSearch = trim($search);
        // unify street search
        if (strtolower(mb_substr($search, -6)) === 'straße') {
            $smallStreetSearch = str_ireplace('straße', 'str', $search);
        }
        if (strtolower(mb_substr($search, -4)) === 'str.') {
            $longStreetSearch = str_ireplace('str.', 'straße', $search);
            $smallStreetSearch = str_ireplace('str.', 'str', $search);
        }
        if (strtolower(mb_substr($search, -3)) === 'str') {
            $longStreetSearch = str_ireplace('str', 'straße', $search);
        }
        $constraint = [];
        if (!empty($longStreetSearch)) {
            $searchConstraint = [];
            $searchConstraint[] = $query->like('company', '%' . $search . '%');
            $searchConstraint[] = $query->like('street', '%' . $smallStreetSearch . '%');
            $searchConstraint[] = $query->like('street', '%' . $longStreetSearch . '%');
            $constraint[] = $query->logicalOr($searchConstraint);
        }
        if (!empty($category)) {
            $constraint[] = $query->logicalOr(
                [
                    $query->contains('mainTrade', $category),
                    $query->contains('trades', $category)
                ]
            );
        }
        if (!empty($constraint)) {
            return $query->matching($query->logicalAnd($constraint))->execute();
        }
        return $query->execute();
    }

    /**
     * Collect all categories used as main_trade and group them
     *
     * @return array
     */
    public function getGroupedCategories(): array
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable('tx_itmedia2_domain_model_company');
        $queryBuilder
            ->select('sc.uid', 'sc.title')
            ->from('tx_itmedia2_domain_model_company', 'c')
            ->leftJoin(
                'c',
                'sys_category_record_mm',
                'mm',
                (string)$queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq(
                        'c.uid',
                        $queryBuilder->quoteIdentifier('mm.uid_foreign')
                    ),
                    $queryBuilder->expr()->eq(
                        'mm.tablenames',
                        $queryBuilder->createNamedParameter('tx_itmedia2_domain_model_company', \PDO::PARAM_STR)
                    ),
                    $queryBuilder->expr()->eq(
                        'mm.fieldname',
                        $queryBuilder->createNamedParameter('main_trade', \PDO::PARAM_STR)
                    )
                )
            )
            ->leftJoin(
                'mm',
                'sys_category',
                'sc',
                $queryBuilder->expr()->eq(
                    'mm.uid_local',
                    $queryBuilder->quoteIdentifier('sc.uid')
                )
            )
            ->groupBy('sc.uid')
            ->orderBy('sc.title', 'ASC');

        /** @var Query $query */
        $query = $this->createQuery();
        $results = $query->statement($queryBuilder)->execute(true);

        $groupedCategories = [];
        $groupedCategories[] = LocalizationUtility::translate('allBranches', 'itmedia2');
        foreach ($results as $result) {
            $groupedCategories[$result['uid']] = $result['title'];
        }

        return $groupedCategories;
    }

    /**
     * Find all records which are older than given days
     * Hint: Needed by scheduler
     *
     * @param int $days
     * @return QueryResultInterface
     */
    public function findOlderThan(int $days): QueryResultInterface
    {
        $days = (int)$days;
        $today = date('U');
        $history = $today - ($days * 60 * 60 * 24);
        $query = $this->createQuery();
        return $query->matching($query->lessThan('tstamp', $history))->execute();
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
