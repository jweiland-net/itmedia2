<?php
declare(strict_types=1);
namespace JWeiland\Itmedia2\Tasks;

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use JWeiland\Itmedia2\Configuration\ExtConf;
use JWeiland\Itmedia2\Domain\Model\Company;
use JWeiland\Itmedia2\Domain\Repository\CompanyRepository;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Hide companies which are older than 13 months.
 * Inform users about entries older than 12 month.
 */
class Update extends AbstractTask
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var PersistenceManager
     */
    protected $persistenceManager;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var MailMessage
     */
    protected $mail;

    /**
     * @var ExtConf
     */
    protected $extConf;

    public function __construct()
    {
        // first we have to call the parent constructor
        parent::__construct();

        // initialize some global variables
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $this->mail = $this->objectManager->get(MailMessage::class);
        $this->extConf = $this->objectManager->get(ExtConf::class);
        $this->companyRepository = $this->objectManager->get(CompanyRepository::class);
        $this->companyRepository->setDefaultQuerySettings($this->getDefaultQuerySettings());
    }

    /**
     * generate default query settings to access all records
     *
     * @return QuerySettingsInterface
     */
    protected function getDefaultQuerySettings(): QuerySettingsInterface
    {
        $settings = $this->objectManager->get(QuerySettingsInterface::class);
        $settings->setIgnoreEnableFields(true);
        $settings->setRespectSysLanguage(false);
        $settings->setRespectStoragePage(false);
        return $settings;
    }

    /**
     * The first method which will be executed when task starts
     *
     * @return bool
     */
    public function execute(): bool
    {
        // hide companies which are older than 13 months
        $companies = $this->companyRepository->findOlderThan(396);
        if ($companies instanceof QueryResult) {
            /** @var $company Company */
            foreach ($companies as $company) {
                $company->setHidden(true);
                $this->companyRepository->update($company);
                if ($company->getEmail()) {
                    $this->informUser($company, 'deactivated');
                }
                $this->informAdmin($company);
            }
            $this->persistenceManager->persistAll();
        }

        // inform users about entries older than 12 month
        $companies = $this->companyRepository->findOlderThan(365);
        if ($companies instanceof QueryResult) {
            /** @var $company Company */
            foreach ($companies as $company) {
                $this->informUser($company, 'inform');
            }
        }

        // Task must return TRUE to signal that it was executed successfully
        return true;
    }

    /**
     * Send mail to user
     *
     * @param Company $company
     * @param string $type "inform" or "deactivated"
     */
    public function informUser(Company $company, string $type)
    {
        $this->mail->setFrom($this->extConf->getEmailFromAddress(), $this->extConf->getEmailFromName());
        $this->mail->setTo($company->getEmail(), $company->getCompany());
        $this->mail->setSubject(LocalizationUtility::translate('email.subject.' . $type . '.user', 'itmedia2'));
        $this->mail->setBody(
            LocalizationUtility::translate(
                'email.body.' . $type . '.user',
                'itmedia2',
                [
                    $company->getUid(),
                    $company->getCompany()
                ]
            ),
            'text/html'
        );

        $this->mail->send();
    }

    /**
     * Inform admin about old company entries
     *
     * @param Company $company
     */
    public function informAdmin(Company $company)
    {
        $this->mail->setFrom($this->extConf->getEmailFromAddress(), $this->extConf->getEmailFromName());
        $this->mail->setTo($this->extConf->getEmailToAddress(), $this->extConf->getEmailToName());
        $this->mail->setSubject(LocalizationUtility::translate('email.subject.deactivated.admin', 'itmedia2'));
        $this->mail->setBody(
            LocalizationUtility::translate(
                'email.body.deactivated.admin',
                'itmedia2',
                [
                    $company->getUid(),
                    $company->getCompany()
                ]
            ),
            'text/html'
        );

        $this->mail->send();
    }

    /**
     * Scheduler serializes this object so we have to tell unserialize() what to do
     */
    public function __wakeup()
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $this->mail = $this->objectManager->get(MailMessage::class);
        $this->extConf = $this->objectManager->get(ExtConf::class);
        $this->companyRepository = $this->objectManager->get(CompanyRepository::class);
        $this->companyRepository->setDefaultQuerySettings($this->getDefaultQuerySettings());
    }

    /**
     * the result of serialization is too big for db. So we reduce the return value
     *
     * @return array
     */
    public function __sleep(): array
    {
        return ['scheduler', 'taskUid', 'disabled', 'execution', 'executionTime'];
    }
}
