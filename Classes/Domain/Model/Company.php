<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Domain\Model;

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

    public function getHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function getWspMember(): bool
    {
        return $this->wspMember;
    }

    public function setWspMember(bool $wspMember): void
    {
        $this->wspMember = $wspMember;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    public function getLogo(): array
    {
        return $this->logo;
    }

    public function setLogo(ObjectStorage $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return FileReference[]
     */
    public function getImages(): array
    {
        $references = [];
        foreach ($this->images as $image) {
            $references[] = $image;
        }
        return $references;
    }

    public function setImages(ObjectStorage $images): void
    {
        $this->images = $images;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }

    public function setContactPerson(string $contactPerson): void
    {
        $this->contactPerson = $contactPerson;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    public function getOpeningTimes(): string
    {
        return $this->openingTimes;
    }

    public function setOpeningTimes(string $openingTimes): void
    {
        $this->openingTimes = $openingTimes;
    }

    public function getBarrierFree(): bool
    {
        return $this->barrierFree;
    }

    public function setBarrierFree(bool $barrierFree): void
    {
        $this->barrierFree = $barrierFree;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDistrict(): ?District
    {
        return $this->district;
    }

    public function setDistrict(?District $district = null): void
    {
        $this->district = $district;
    }

    public function getMainTrade(): ObjectStorage
    {
        return $this->mainTrade;
    }

    public function setMainTrade(ObjectStorage $mainTrade): void
    {
        $this->mainTrade = $mainTrade;
    }

    public function getTrades(): ObjectStorage
    {
        return $this->trades;
    }

    public function setTrades(ObjectStorage $trades): void
    {
        $this->trades = $trades;
    }

    public function getFacebook(): string
    {
        return $this->facebook;
    }

    public function setFacebook(string $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getTwitter(): string
    {
        return $this->twitter;
    }

    public function setTwitter(string $twitter): void
    {
        $this->twitter = $twitter;
    }

    public function getGoogle(): string
    {
        return $this->google;
    }

    public function setGoogle(string $google): void
    {
        $this->google = $google;
    }

    public function getTxMaps2Uid(): ?PoiCollection
    {
        return $this->txMaps2Uid;
    }

    public function setTxMaps2Uid(?PoiCollection $txMaps2Uid = null): void
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
     * @return ObjectStorage|Floor[]
     */
    public function getFloors(): ObjectStorage
    {
        return $this->floors;
    }

    public function setFloors(ObjectStorage $floors): void
    {
        $this->floors = $floors;
    }

    public function getImageMaps(): ObjectStorage
    {
        return $this->imageMaps;
    }

    public function setImageMaps(ObjectStorage $imageMaps): void
    {
        $this->imageMaps = $imageMaps;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position = null): void
    {
        $this->position = $position;
    }
}
