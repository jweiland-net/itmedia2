<?php
declare(strict_types=1);
namespace JWeiland\Itmedia2\Domain\Model;

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

use JWeiland\Maps2\Domain\Model\PoiCollection;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Domain model to keep information about companies
 */
class Company extends AbstractEntity
{
    /**
     * Hidden
     *
     * @var bool
     */
    protected $hidden = false;

    /**
     * WSP Member
     *
     * @var bool
     */
    protected $wspMember = false;

    /**
     * Company
     *
     * @var string
     * @validate NotEmpty
     */
    protected $company = '';

    /**
     * Logo
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $logo;

    /**
     * Images
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $images;

    /**
     * Street
     *
     * @var string
     * @validate NotEmpty
     */
    protected $street = '';

    /**
     * house number
     *
     * @var string
     * @validate NotEmpty
     */
    protected $houseNumber = '';

    /**
     * Zip
     *
     * @var string
     * @validate NotEmpty
     */
    protected $zip = '';

    /**
     * City
     *
     * @var string
     * @validate NotEmpty
     */
    protected $city = '';

    /**
     * Telephone
     *
     * @var string
     */
    protected $telephone = '';

    /**
     * Fax
     *
     * @var string
     */
    protected $fax = '';

    /**
     * Contact person
     *
     * @var string
     */
    protected $contactPerson = '';

    /**
     * Email
     *
     * @var string
     */
    protected $email = '';

    /**
     * Website
     *
     * @var string
     */
    protected $website = '';

    /**
     * Opening times
     *
     * @var string
     */
    protected $openingTimes = '';

    /**
     * Barrier-free
     *
     * @var boolean
     */
    protected $barrierFree = false;

    /**
     * Description
     *
     * @var string
     * @validate NotEmpty
     */
    protected $description = '';

    /**
     * District
     *
     * @var \JWeiland\Itmedia2\Domain\Model\District
     * @validate NotEmpty
     * @lazy
     */
    protected $district;

    /**
     * MainTrade
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\Category
     * @validate NotEmpty
     * @lazy
     */
    protected $mainTrade;

    /**
     * trades
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     * @lazy
     */
    protected $trades;

    /**
     * Facebook
     *
     * @var string
     */
    protected $facebook = '';

    /**
     * Twitter
     *
     * @var string
     */
    protected $twitter = '';

    /**
     * Google
     *
     * @var string
     */
    protected $google = '';

    /**
     * TxMaps2Uid
     *
     * @var \JWeiland\Maps2\Domain\Model\PoiCollection
     */
    protected $txMaps2Uid;

    /**
     * Constructor of this object
     */
    public function __construct()
    {
        $this->trades = new ObjectStorage();
        $this->images = new ObjectStorage();
    }

    /**
     * Returns the hidden
     *
     * @return bool $hidden
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Sets the hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * Returns the wspMember
     *
     * @return bool $wspMember
     */
    public function getWspMember()
    {
        return $this->wspMember;
    }

    /**
     * Sets the wspMember
     *
     * @param bool $wspMember
     */
    public function setWspMember(bool $wspMember)
    {
        $this->wspMember = $wspMember;
    }

    /**
     * Returns the company
     *
     * @return string $company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Sets the company
     *
     * @param string $company
     */
    public function setCompany(string $company)
    {
        $this->company = $company;
    }

    /**
     * Returns the logo
     * This is only needed by the edit form
     *
     * @return FileReference $logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Sets the logo
     *
     * @param FileReference $logo
     */
    public function setLogo(FileReference $logo = null)
    {
        $this->logo = $logo;
    }

    /**
     * Returns the images
     * This is only allowed in edit form
     *
     * @return array $images
     */
    public function getImages()
    {
        $references = array();
        foreach ($this->images as $image) {
            $references[] = $image;
        }
        return $references;
    }

    /**
     * Sets the images
     *
     * @param ObjectStorage $images A minimized Array from $_FILES
     */
    public function setImages(ObjectStorage $images)
    {
        $this->images = $images;
    }

    /**
     * Returns the street
     *
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Sets the street
     *
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * Returns the houseNumber
     *
     * @return string $houseNumber
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Sets the houseNumber
     *
     * @param string $houseNumber
     */
    public function setHouseNumber(string $houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * Returns the telephone
     *
     * @return string $telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Sets the telephone
     *
     * @param string $telephone
     */
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Returns the fax
     *
     * @return string $fax
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Sets the fax
     *
     * @param string $fax
     */
    public function setFax(string $fax)
    {
        $this->fax = $fax;
    }

    /**
     * Returns the contactPerson
     *
     * @return string $contactPerson
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Sets the contactPerson
     *
     * @param string $contactPerson
     */
    public function setContactPerson(string $contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Returns the website
     *
     * @return string $website
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Sets the website
     *
     * @param string $website
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * Returns the openingTimes
     *
     * @return string $openingTimes
     */
    public function getOpeningTimes()
    {
        return $this->openingTimes;
    }

    /**
     * Sets the openingTimes
     *
     * @param string $openingTimes
     */
    public function setOpeningTimes(string $openingTimes)
    {
        $this->openingTimes = $openingTimes;
    }

    /**
     * Returns the barrierFree
     *
     * @return bool $barrierFree
     */
    public function getBarrierFree()
    {
        return $this->barrierFree;
    }

    /**
     * Sets the barrierFree
     *
     * @param bool $barrierFree
     */
    public function setBarrierFree(bool $barrierFree)
    {
        $this->barrierFree = $barrierFree;
    }

    /**
     * Returns the boolean state of barrierFree
     *
     * @return bool
     */
    public function isBarrierFree()
    {
        return $this->getBarrierFree();
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Returns the district
     *
     * @return District $district
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Sets the district
     *
     * @param District $district
     */
    public function setDistrict(District $district = null)
    {
        $this->district = $district;
    }

    /**
     * Returns the mainTrade
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\Category $mainTrade
     */
    public function getMainTrade()
    {
        return $this->mainTrade;
    }

    /**
     * Sets the mainTrade
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $mainTrade
     */
    public function setMainTrade(\TYPO3\CMS\Extbase\Domain\Model\Category $mainTrade = null)
    {
        $this->mainTrade = $mainTrade;
    }

    /**
     * Returns the trades
     *
     * @return ObjectStorage $trades
     */
    public function getTrades()
    {
        return $this->trades;
    }

    /**
     * Sets the trades
     *
     * @param ObjectStorage $trades
     */
    public function setTrades(ObjectStorage $trades)
    {
        $this->trades = $trades;
    }

    /**
     * Returns the facebook
     *
     * @return string $facebook
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Sets the facebook
     *
     * @param string $facebook
     */
    public function setFacebook(string $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * Returns the twitter
     *
     * @return string $twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Sets the twitter
     *
     * @param string $twitter
     */
    public function setTwitter(string $twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * Returns the google
     *
     * @return string $google
     */
    public function getGoogle()
    {
        return $this->google;
    }

    /**
     * Sets the google
     *
     * @param string $google
     */
    public function setGoogle(string $google)
    {
        $this->google = $google;
    }

    /**
     * Returns the txMaps2Uid
     *
     * @return PoiCollection $txMaps2Uid
     */
    public function getTxMaps2Uid()
    {
        return $this->txMaps2Uid;
    }

    /**
     * Sets the txMaps2Uid
     *
     * @param PoiCollection $txMaps2Uid
     */
    public function setTxMaps2Uid(PoiCollection $txMaps2Uid)
    {
        $this->txMaps2Uid = $txMaps2Uid;
    }

    /**
     * helper method to get the address of the record
     * this is needed by google maps geocode API
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getStreet() . ' ' . $this->getHouseNumber() . ', ' . $this->getZip() . ' ' . $this->getCity();
    }
}
