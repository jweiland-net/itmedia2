<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\EventListener;

use JWeiland\Glossary2\Service\GlossaryService;
use JWeiland\Itmedia2\Domain\Repository\CompanyRepository;
use JWeiland\Itmedia2\Event\PostProcessFluidVariablesEvent;
use TYPO3\CMS\Core\Utility\ArrayUtility;

class AddGlossaryEventListener extends AbstractControllerEventListener
{
    /**
     * @var GlossaryService
     */
    protected $glossaryService;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    protected $allowedControllerActions = [
        'Company' => [
            'list',
            'search',
        ],
    ];

    public function __construct(GlossaryService $glossaryService, CompanyRepository $companyRepository)
    {
        $this->glossaryService = $glossaryService;
        $this->companyRepository = $companyRepository;
    }

    public function __invoke(PostProcessFluidVariablesEvent $event): void
    {
        if ($this->isValidRequest($event)) {
            $event->addFluidVariable(
                'glossar',
                $this->glossaryService->buildGlossary(
                    $this->companyRepository->getQueryBuilderToFindAllEntries(),
                    $this->getOptions($event)
                )
            );
        }
    }

    protected function getOptions(PostProcessFluidVariablesEvent $event): array
    {
        $options = [
            'extensionName' => 'itmedia2',
            'pluginName' => 'directory',
            'controllerName' => 'Company',
            'column' => 'company',
            'settings' => $event->getSettings(),
        ];

        if (
            isset($event->getSettings()['glossary'])
            && is_array($event->getSettings()['glossary'])
        ) {
            ArrayUtility::mergeRecursiveWithOverrule($options, $event->getSettings()['glossary']);
        }

        return $options;
    }
}
