<?php
declare(strict_types=1);
namespace JWeiland\Itmedia2\Domain\Repository;

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

use JWeiland\Itmedia2\Domain\Model\Company;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Charset\CharsetConverter;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class CompanyRepository
 *
 * @package JWeiland\Itmedia2\Domain\Repository
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
     * charset converter
     * We need some UTF-8 compatible functions for search
     *
     * @var \TYPO3\CMS\Core\Charset\CharsetConverter
     */
    protected $charsetConverter;

    /**
     * injects charsetConverter
     *
     * @param CharsetConverter $charsetConverter
     * @return void
     */
    public function injectCharsetConverter(CharsetConverter $charsetConverter)
    {
        $this->charsetConverter = $charsetConverter;
    }

    /**
     * find company by uid whether it is hidden or not
     *
     * @param int $companyUid
     * @return Company
     */
    public function findHiddenEntryByUid($companyUid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setEnableFieldsToBeIgnored(['disabled']);

        /** @var Company $company */
        $company = $query->matching($query->equals('uid', (int)$companyUid))->execute()->getFirst();
        return $company;
    }

    /**
     * find all records starting with given letter
     *
     * @param string $letter
     * @param array $settings
     * @return QueryResultInterface
     */
    public function findByStartingLetter($letter, array $settings = [])
    {
        $query = $this->createQuery();

        $constraintAnd = [];

        if ($letter) {
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
     * get an array with available starting letters
     *
     * @param boolean $isWsp
     * @return array
     */
    public function getStartingLetters($isWsp)
    {
        $addWhere = '';

        if ($isWsp) {
            $addWhere = 'AND wsp_member=1';
        }

        /** @var Query $query */
        $query = $this->createQuery();
        return $query->statement('
			SELECT UPPER(LEFT(company, 1)) as letter
			FROM tx_itmedia2_domain_model_company
			WHERE 1=1 ' . $addWhere .
            BackendUtility::BEenableFields('tx_itmedia2_domain_model_company')    .
            BackendUtility::deleteClause('tx_itmedia2_domain_model_company')    . '
			GROUP BY letter
			ORDER by letter;
		')->execute(true);
    }

    /**
     * search records
     *
     * @param string $search
     * @param int $category
     * @return QueryResultInterface
     */
    public function searchCompanies($search, $category)
    {
        // strtolower is not UTF-8 compatible
        // $search = strtolower($search);
        $longStreetSearch = $search;
        $smallStreetSearch = $search;

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

        /** @var Query $query */
        $query = $this->createQuery();

        $constraint = [];
        $constraint[] = $query->like('company', '%' . $search . '%');
        $constraint[] = $query->like('street', '%' . $smallStreetSearch . '%');
        $constraint[] = $query->like('street', '%' . $longStreetSearch . '%');

        if ($category) {
            return $query->matching(
                $query->logicalAnd(
                    $query->logicalOr($constraint),
                    $query->logicalOr(
                        [
                        $query->equals('mainTrade', $category),
                        $query->contains('trades', $category)
                        ]
                    )
                )
            )->execute();
        }

        return $query->matching(
            $query->logicalOr($constraint)
        )->execute();
    }

    /**
     * return grouped categories
     *
     * @return array
     */
    public function getGroupedCategories()
    {
        /** @var Query $query */
        $query = $this->createQuery();
        $results = $query->statement(
            '
			SELECT sys_category.uid, sys_category.title
			FROM sys_category, tx_itmedia2_domain_model_company
			WHERE tx_itmedia2_domain_model_company.main_trade = sys_category.uid
			AND tx_itmedia2_domain_model_company.main_trade > 0 ' .
                BackendUtility::BEenableFields('sys_category') .
                BackendUtility::deleteClause('sys_category') .
                BackendUtility::BEenableFields('tx_itmedia2_domain_model_company') .
                BackendUtility::deleteClause('tx_itmedia2_domain_model_company') . '
				GROUP BY sys_category.uid
				ORDER BY sys_category.title'
        )->execute(true);

        $groupedCategories = [];
        $groupedCategories[] = LocalizationUtility::translate('allBranches', 'itmedia2');
        foreach ($results as $result) {
            $groupedCategories[$result['uid']] = $result['title'];
        }

        return $groupedCategories;
    }

    /**
     * find all records which are older than given days
     * Hint: Needed by scheduler
     *
     * @param int $days
     * @return QueryResultInterface
     */
    public function findOlderThan($days)
    {
        $days = (int) $days;
        $today = date('U');
        $history = $today - ($days * 60 * 60 * 24);
        $query = $this->createQuery();
        return $query->matching($query->lessThan('tstamp', $history))->execute();
    }
}
