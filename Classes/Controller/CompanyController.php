<?php
declare(strict_types=1);
namespace JWeiland\Itmedia2\Controller;

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
 * Controller which keeps methods to list and show companies
 */
class CompanyController extends AbstractController
{
    /**
     * action list
     *
     * @param string $letter Show only records starting with this letter
     * @validate $letter String, StringLength(minimum=0,maximum=3)
     * @return void
     */
    public function listAction($letter = null)
    {
        $companies = $this->companyRepository->findByStartingLetter($letter, $this->settings);

        $this->view->assign('companies', $companies);
        $this->view->assign('glossar', $this->getGlossar($this->settings['showWspMembers']));
        $this->view->assign('categories', $this->companyRepository->getGroupedCategories());
        $this->view->assign('fallbackIconPath', $this->extConf->getFallbackIconPath());
    }

    /**
     * action show
     *
     * @param int $company
     * @return void
     */
    public function showAction($company)
    {
        $companyObject = $this->companyRepository->findByIdentifier($company);
        $this->view->assign('company', $companyObject);
        $this->view->assign('fallbackIconPath', $this->extConf->getFallbackIconPath());
    }

    /**
     * secure search parameter
     *
     * @return void
     */
    public function initializeSearchAction()
    {
        if ($this->request->hasArgument('search')) {
            $search = $this->request->getArgument('search');
            $this->request->setArgument('search', htmlspecialchars($search));
        }
    }

    /**
     * search show
     *
     * @param string $search
     * @param int $category
     * @return void
     */
    public function searchAction($search, $category = 0)
    {
        $companies = $this->companyRepository->searchCompanies($search, $category);
        $this->view->assign('search', $search);
        $this->view->assign('category', $category);
        $this->view->assign('companies', $companies);
        $this->view->assign('glossar', $this->getGlossar($this->settings['showWspMembers']));
        $this->view->assign('categories', $this->companyRepository->getGroupedCategories());
        $this->view->assign('fallbackIconPath', $this->extConf->getFallbackIconPath());
    }
}
