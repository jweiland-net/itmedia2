<?php
namespace JWeiland\Yellowpages2light\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Stefan Froemken <projects@jweiland.net>, jweiland.net
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use JWeiland\Maps2\Domain\Model\PoiCollection;
use JWeiland\Maps2\Domain\Model\RadiusResult;
use JWeiland\Yellowpages2light\Domain\Model\Company;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * @package yellowpages2light
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AbstractController extends ActionController
{
    /**
     * @var \TYPO3\CMS\Core\Mail\MailMessage
     */
    protected $mail;

    /**
     * @var \JWeiland\Yellowpages2light\Configuration\ExtConf
     */
    protected $extConf;

    /**
     * persistenceManager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * companyRepository
     *
     * @var \JWeiland\Yellowpages2light\Domain\Repository\CompanyRepository
     */
    protected $companyRepository;

    /**
     * districtRepository
     *
     * @var \JWeiland\Yellowpages2light\Domain\Repository\DistrictRepository
     */
    protected $districtRepository;

    /**
     * categoryRepository
     *
     * @var \JWeiland\Yellowpages2light\Domain\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\Session
     */
    protected $session;

    /**
     * @var \JWeiland\Maps2\Utility\GeocodeUtility
     */
    protected $geocodeUtility;

    /**
     * @var string
     */
    protected $letters = '0-9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';

    /**
     * inject mail
     *
     * @param \TYPO3\CMS\Core\Mail\MailMessage $mail
     * @return void
     */
    public function injectMail(\TYPO3\CMS\Core\Mail\MailMessage $mail)
    {
        $this->mail = $mail;
    }

    /**
     * inject extConf
     *
     * @param \JWeiland\Yellowpages2light\Configuration\ExtConf $extConf
     * @return void
     */
    public function injectExtConf(\JWeiland\Yellowpages2light\Configuration\ExtConf $extConf)
    {
        $this->extConf = $extConf;
    }

    /**
     * inject persistenceManager
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager
     * @return void
     */
    public function injectPersistenceManager(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * inject companyRepository
     *
     * @param \JWeiland\Yellowpages2light\Domain\Repository\CompanyRepository $companyRepository
     * @return void
     */
    public function injectCompanyRepository(\JWeiland\Yellowpages2light\Domain\Repository\CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * inject districtRepository
     *
     * @param \JWeiland\Yellowpages2light\Domain\Repository\DistrictRepository $districtRepository
     * @return void
     */
    public function injectDistrictRepository(\JWeiland\Yellowpages2light\Domain\Repository\DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    /**
     * inject categoryRepository
     *
     * @param \JWeiland\Yellowpages2light\Domain\Repository\CategoryRepository $categoryRepository
     * @return void
     */
    public function injectCategoryRepository(\JWeiland\Yellowpages2light\Domain\Repository\CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * inject session
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Session $session
     * @return void
     */
    public function injectSession(\TYPO3\CMS\Extbase\Persistence\Generic\Session $session)
    {
        $this->session = $session;
    }

    /**
     * inject geocodeUtility
     *
     * @param \JWeiland\Maps2\Utility\GeocodeUtility $geocodeUtility
     * @return void
     */
    public function injectGeocodeUtility(\JWeiland\Maps2\Utility\GeocodeUtility $geocodeUtility)
    {
        $this->geocodeUtility = $geocodeUtility;
    }

    /**
     * PreProcessing of all actions
     *
     * @return void
     */
    public function initializeAction()
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to NULL
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    /**
     * get an array with letters as keys for the glossar
     *
     * @param boolean $isWsp
     * @return array Array with starting letters as keys
     */
    protected function getGlossar($isWsp)
    {
        $glossar = array();
        $availableLetters = $this->companyRepository->getStartingLetters($isWsp);
        $possibleLetters = GeneralUtility::trimExplode(',', $this->letters);

        // add all letters which we have found in DB
        foreach ($availableLetters as $availableLetter) {
            if (MathUtility::canBeInterpretedAsInteger($availableLetter['letter'])) {
                $availableLetter['letter'] = '0-9';
            }
            // add only letters which are valid (do not add "§$%")
            if (array_search($availableLetter['letter'], $possibleLetters) !== false) {
                $glossar[$availableLetter['letter']] = true;
            }
        }

        // add all valid letters which are not set/found by previous foreach
        foreach ($possibleLetters as $possibleLetter) {
            if (!array_key_exists($possibleLetter, $glossar)) {
                $glossar[$possibleLetter] = false;
            }
        }

        ksort($glossar, SORT_STRING);

        return $glossar;
    }

    /**
     * This is a workaround to help controller actions to find (hidden) companies
     *
     * @param $argumentName
     */
    protected function registerCompanyFromRequest($argumentName)
    {
        $argument = $this->request->getArgument($argumentName);
        if (is_array($argument)) {
            // get company from form ($_POST)
            $company = $this->companyRepository->findHiddenEntryByUid($argument['__identity']);
        } else {
            // get company from UID
            $company = $this->companyRepository->findHiddenEntryByUid($argument);
        }
        $this->session->registerObject($company, $company->getUid());
    }

    /**
     * A template method for displaying custom error flash messages, or to
     * display no flash message at all on errors. Override this to customize
     * the flash message in your action controller.
     *
     * @return string The flash message or FALSE if no flash message should be set
     * @api
     */
    protected function getErrorFlashMessage()
    {
        return LocalizationUtility::translate('errorFlashMessage', 'yellowpages2light', array(
            get_class($this),
            $this->actionMethodName
        ));
    }

    /**
     * remove empty arguments from request
     *
     * @return void
     */
    protected function removeEmptyArgumentsFromRequest()
    {
        $company = $this->request->getArgument('company');
        $company['trades'] = GeneralUtility::removeArrayEntryByValue($company['trades'], '');
        if ($company['trades'] === array()) {
            unset($company['trades']);
        }
        $this->request->setArgument('company', $company);
    }

    /**
     * files will be uploaded in typeConverter automatically
     * But, if an error occurs we have to remove them
     *
     * @param string $argument
     * @return void
     */
    protected function deleteUploadedFilesOnValidationErrors($argument)
    {
        if ($this->getControllerContext()->getRequest()->hasArgument($argument)) {
            $company = $this->getControllerContext()->getRequest()->getArgument($argument);
            if ($company['images'] !== array()) {
                unset($company['images']);
            }
            if ($company['logo'] !== array()) {
                unset($company['logo']);
            }
            $this->getControllerContext()->getRequest()->setArgument($argument, $company);
        }
    }

    /**
     * Add new PoiCollection to Company, if company is new
     *
     * @param Company $company
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function addNewPoiCollectionToCompany(Company $company)
    {
        $response = $this->geocodeUtility->findPositionByAddress($company->getAddress());
        /* @var \JWeiland\Maps2\Domain\Model\RadiusResult $location */
        $location = $response->current();
        if ($location instanceof RadiusResult) {
            /** @var PoiCollection $poiCollection */
            $poiCollection = $this->objectManager->get('JWeiland\\Maps2\\Domain\\Model\\PoiCollection');
            $poiCollection->setCollectionType('Point');
            $poiCollection->setTitle($company->getCompany());
            $poiCollection->setLatitude($location->getGeometry()->getLocation()->getLatitude());
            $poiCollection->setLongitude($location->getGeometry()->getLocation()->getLongitude());
            $poiCollection->setAddress($location->getFormattedAddress());
            $company->setTxMaps2Uid($poiCollection);
        } else {
            DebuggerUtility::var_dump($response);
            throw new \Exception('Can\'t find a result for address: ' . $company->getAddress() . '. Activate Debugging for a more detailed output.', 1465474954);
        }
    }
}
