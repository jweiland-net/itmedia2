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
     * @var bool
     */
    protected $hidden = false;

    /**
     * @var bool
     */
    protected $wspMember = false;

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $company = '';

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $logo;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $images;

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $street = '';

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $houseNumber = '';

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $zip = '';

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $city = '';

    /**
     * @var string
     */
    protected $telephone = '';

    /**
     * @var string
     */
    protected $fax = '';

    /**
     * @var string
     */
    protected $contactPerson = '';

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $website = '';

    /**
     * @var string
     */
    protected $openingTimes = '';

    /**
     * @var bool
     */
    protected $barrierFree = false;

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $description = '';

    /**
     * @var \JWeiland\Itmedia2\Domain\Model\District
     * @validate NotEmpty
     * @lazy
     */
    protected $district;

    /**
     * @var \JWeiland\Itmedia2\Domain\Model\Category
     * @validate NotEmpty
     * @lazy
     */
    protected $mainTrade;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     * @lazy
     */
    protected $trades;

    /**
     * @var string
     */
    protected $facebook = '';

    /**
     * @var string
     */
    protected $twitter = '';

    /**
     * @var string
     */
    protected $google = '';

    /**
     * @var \JWeiland\Maps2\Domain\Model\PoiCollection
     */
    protected $txMaps2Uid;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Itmedia2\Domain\Model\Floor>
     */
    protected $floors;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $imageMaps;

    /**
     * @var \JWeiland\Itmedia2\Domain\Model\Position
     */
    protected $position;

    public function __construct()
    {
        $this->trades = new ObjectStorage();
        $this->images = new ObjectStorage();
        $this->imageMaps = new ObjectStorage();
        $this->floors = new ObjectStorage();
    }

    /**
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * @return bool
     */
    public function getWspMember(): bool
    {
        return $this->wspMember;
    }

    /**
     * @param bool $wspMember
     */
    public function setWspMember(bool $wspMember)
    {
        $this->wspMember = $wspMember;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company)
    {
        $this->company = $company;
    }

    /**
     * @return FileReference
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param FileReference|null $logo
     */
    public function setLogo(FileReference $logo = null)
    {
        $this->logo = $logo;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        $references = [];
        foreach ($this->images as $image) {
            $references[] = $image;
        }
        return $references;
    }

    /**
     * @param ObjectStorage $images A minimized Array from $_FILES
     */
    public function setImages(ObjectStorage $images)
    {
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @param string $houseNumber
     */
    public function setHouseNumber(string $houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * @return string $zip
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getFax(): string
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax(string $fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }

    /**
     * @param string $contactPerson
     */
    public function setContactPerson(string $contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getOpeningTimes(): string
    {
        return $this->openingTimes;
    }

    /**
     * @param string $openingTimes
     */
    public function setOpeningTimes(string $openingTimes)
    {
        $this->openingTimes = $openingTimes;
    }

    /**
     * @return bool $barrierFree
     */
    public function getBarrierFree(): bool
    {
        return $this->barrierFree;
    }

    /**
     * @param bool $barrierFree
     */
    public function setBarrierFree(bool $barrierFree)
    {
        $this->barrierFree = $barrierFree;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return District|null
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param District $district
     */
    public function setDistrict(District $district = null)
    {
        $this->district = $district;
    }

    /**
     * @return Category|null
     */
    public function getMainTrade()
    {
        return $this->mainTrade;
    }

    /**
     * @param Category $mainTrade
     */
    public function setMainTrade(Category $mainTrade = null)
    {
        $this->mainTrade = $mainTrade;
    }

    /**
     * @return ObjectStorage
     */
    public function getTrades(): ObjectStorage
    {
        return $this->trades;
    }

    /**
     * @param ObjectStorage $trades
     */
    public function setTrades(ObjectStorage $trades)
    {
        $this->trades = $trades;
    }

    /**
     * @return string
     */
    public function getFacebook(): string
    {
        return $this->facebook;
    }

    /**
     * @param string $facebook
     */
    public function setFacebook(string $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param string $twitter
     */
    public function setTwitter(string $twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string
     */
    public function getGoogle(): string
    {
        return $this->google;
    }

    /**
     * @param string $google
     */
    public function setGoogle(string $google)
    {
        $this->google = $google;
    }

    /**
     * @return PoiCollection|null
     */
    public function getTxMaps2Uid()
    {
        return $this->txMaps2Uid;
    }

    /**
     * @param PoiCollection|null $txMaps2Uid
     */
    public function setTxMaps2Uid(PoiCollection $txMaps2Uid = null)
    {
        $this->txMaps2Uid = $txMaps2Uid;
    }

    /**
     * helper method to get the address of the record
     * this is needed by google maps geocode API
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->getStreet() . ' ' . $this->getHouseNumber() . ', ' . $this->getZip() . ' ' . $this->getCity();
    }

    /**
     * @return ObjectStorage|Floor[]|null
     */
    public function getFloors()
    {
        return $this->floors;
    }

    /**
     * @param ObjectStorage $floors
     */
    public function setFloors(ObjectStorage $floors)
    {
        $this->floors = $floors;
    }

    /**
     * @return ObjectStorage|null
     */
    public function getImageMaps()
    {
        return $this->imageMaps;
    }

    /**
     * @param ObjectStorage $imageMaps
     */
    public function setImageMaps(ObjectStorage $imageMaps)
    {
        $this->imageMaps = $imageMaps;
    }

    /**
     * @return Position|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param Position $position
     */
    public function setPosition(Position $position)
    {
        $this->position = $position;
    }
}
