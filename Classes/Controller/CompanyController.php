<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Controller;

use JWeiland\Itmedia2\Domain\Repository\CompanyRepository;
use JWeiland\Itmedia2\Event\PostProcessFluidVariablesEvent;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\Session;

/**
 * Controller which keeps methods to list and show companies
 */
class CompanyController extends ActionController
{
    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var Session
     */
    protected $session;

    public function injectCompanyRepository(CompanyRepository $companyRepository): void
    {
        $this->companyRepository = $companyRepository;
    }

    public function injectSession(Session $session): void
    {
        $this->session = $session;
    }

    public function initializeAction(): void
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to NULL
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    /**
     * @param string $letter Show only records starting with this letter
     * @Extbase\Validate("String", param="letter")
     * @Extbase\Validate("StringLength", param="letter", options={"minimum": 0, "maximum": 3})
     */
    public function listAction(string $letter = ''): void
    {
        $this->postProcessAndAssignFluidVariables([
            'companies' => $this->companyRepository->findByLetter($letter, $this->settings),
            'categories' => $this->companyRepository->getTranslatedCategories()
        ]);
    }

    /**
     * @param int $company
     */
    public function showAction(int $company): void
    {
        $this->postProcessAndAssignFluidVariables([
            'company', $this->companyRepository->findByIdentifier($company)
        ]);
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
        $this->postProcessAndAssignFluidVariables([
            'search' => $search,
            'category' => $category,
            'companies' => $this->companyRepository->searchCompanies($search, $category, $this->settings),
            'categories' => $this->companyRepository->getTranslatedCategories(),
        ]);
    }

    protected function postProcessAndAssignFluidVariables(array $variables = []): void
    {
        /** @var PostProcessFluidVariablesEvent $event */
        $event = $this->eventDispatcher->dispatch(
            new PostProcessFluidVariablesEvent(
                $this->request,
                $this->settings,
                $variables
            )
        );

        $this->view->assignMultiple($event->getFluidVariables());
    }
}
