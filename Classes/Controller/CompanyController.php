<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Controller;

/**
 * Controller which keeps methods to list and show companies
 */
class CompanyController extends AbstractController
{
    /**
     * @param string $letter Show only records starting with this letter
     * @validate $letter String, StringLength(minimum=0,maximum=3)
     */
    public function listAction(string $letter = ''): void
    {
        $companies = $this->companyRepository->findByStartingLetter($letter, $this->settings);

        $this->view->assign('companies', $companies);
        $this->view->assign('glossar', $this->getGlossar());
        $this->view->assign('categories', $this->companyRepository->getGroupedCategories());
    }

    /**
     * @param int $company
     */
    public function showAction(int $company): void
    {
        $companyObject = $this->companyRepository->findByIdentifier($company);
        $this->view->assign('company', $companyObject);
    }

    public function initializeSearchAction(): void
    {
        if ($this->request->hasArgument('search')) {
            $search = $this->request->getArgument('search');
            $this->request->setArgument('search', htmlspecialchars($search));
        }
    }

    public function searchAction(string $search, int $category = 0): void
    {
        $companies = $this->companyRepository->searchCompanies($search, $category);
        $this->view->assign('search', $search);
        $this->view->assign('category', $category);
        $this->view->assign('companies', $companies);
        $this->view->assign('glossar', $this->getGlossar());
        $this->view->assign('categories', $this->companyRepository->getGroupedCategories());
    }
}
