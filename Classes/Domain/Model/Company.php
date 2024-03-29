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
use JWeiland\Yellowpages2\Domain\Model\District;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Domain\Model\Category;
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
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $company = '';

    /**
     * @var ObjectStorage<FileReference>
     */
    protected $logo;

    /**
     * @var ObjectStorage<FileReference>
     */
    protected $images;

    /**
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $street = '';

    /**
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $houseNumber = '';

    /**
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $zip = '';

    /**
     * @var string
     * @Extbase\Validate("NotEmpty")
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
     * @Extbase\Validate("NotEmpty")
     */
    protected $description = '';

    /**
     * @var District
     * @Extbase\Validate("NotEmpty")
     * @Extbase\ORM\Lazy
     */
    protected $district;

    /**
     * @var ObjectStorage<Category>
     * @Extbase\Validate("NotEmpty")
     * @Extbase\ORM\Lazy
     */
    protected $mainTrade;

    /**
     * @var ObjectStorage<Category>
     * @Extbase\ORM\Lazy
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
    protected $instagram = '';

    /**
     * @var PoiCollection
     */
    protected $txMaps2Uid;

    /**
     * @var ObjectStorage<Floor>
     */
    protected $floors;

    /**
     * @var ObjectStorage<FileReference>
     */
    protected $imageMaps;

    /**
     * @var Position
     */
    protected $position;

    public function __construct()
    {
        $this->logo = new ObjectStorage();
        $this->images = new ObjectStorage();
        $this->mainTrade = new ObjectStorage();
        $this->trades = new ObjectStorage();
        $this->imageMaps = new ObjectStorage();
        $this->floors = new ObjectStorage();
    }

    /**
     * Called again with initialize object, as fetching an entity from the DB does not use the constructor
     */
    public function initializeObject()
    {
        $this->logo = $this->logo ?? new ObjectStorage();
        $this->images = $this->images ?? new ObjectStorage();
        $this->mainTrade = $this->mainTrade ?? new ObjectStorage();
        $this->trades = $this->trades ?? new ObjectStorage();
        $this->imageMaps = $this->imageMaps ?? new ObjectStorage();
        $this->floors = $this->floors ?? new ObjectStorage();
    }

    public function getHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * @return FileReference[]
     */
    public function getLogo(): array
    {
        return $this->logo->toArray();
    }

    public function getFirstLogo(): ?FileReference
    {
        $this->logo->rewind();
        return $this->logo->current();
    }

    public function getOriginalLogo(): ObjectStorage
    {
        return $this->logo;
    }

    public function setLogo(ObjectStorage $logo): void
    {
        $this->logo = $logo;
    }

    public function addLogo(FileReference $logo): void
    {
        $this->logo->attach($logo);
    }

    public function removeLogo(FileReference $logo): void
    {
        $this->logo->detach($logo);
    }

    /**
     * @return array|FileReference[]
     */
    public function getImages(): array
    {
        return $this->images->toArray();
    }

    /**
     * @return ObjectStorage|FileReference[]
     */
    public function getOriginalImages(): ObjectStorage
    {
        return $this->images;
    }

    public function setImages(ObjectStorage $images): void
    {
        $this->images = $images;
    }

    public function addImage(FileReference $image): void
    {
        $this->images->attach($image);
    }

    public function removeImage(FileReference $image): void
    {
        $this->images->detach($image);
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

    public function setDistrict(?District $district): void
    {
        $this->district = $district;
    }

    /**
     * @return Category[]
     */
    public function getMainTrade(): array
    {
        return $this->mainTrade->toArray();
    }

    public function getFirstMainTrade(): ?Category
    {
        $this->mainTrade->rewind();
        return $this->mainTrade->current();
    }

    public function getOriginalMainTrade(): ObjectStorage
    {
        return $this->mainTrade;
    }

    public function setMainTrade(ObjectStorage $mainTrade): void
    {
        $this->mainTrade = $mainTrade;
    }

    public function addMainTrade(Category $mainTrade): void
    {
        $this->mainTrade->attach($mainTrade);
    }

    public function removeMainTrade(Category $mainTrade): void
    {
        $this->mainTrade->detach($mainTrade);
    }

    /**
     * @return Category[]
     */
    public function getTrades(): array
    {
        return $this->trades->toArray();
    }

    public function getOriginalTrades(): ObjectStorage
    {
        return $this->trades;
    }

    public function setTrades(ObjectStorage $trades): void
    {
        $this->trades = $trades;
    }

    public function addTrade(Category $trade): void
    {
        $this->trades->attach($trade);
    }

    public function removeTrade(Category $trade): void
    {
        $this->trades->detach($trade);
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

    public function getInstagram(): string
    {
        return $this->instagram;
    }

    public function setInstagram(string $instagram): void
    {
        $this->instagram = $instagram;
    }

    /**
     * SF: Do not add PoiCollection as strict_type to $txMaps2Uid
     * as this will break DataMap in Extbase when maps2 is not installed.
     */
    public function getTxMaps2Uid()
    {
        return $this->txMaps2Uid;
    }

    public function setTxMaps2Uid($txMaps2Uid): void
    {
        if ($txMaps2Uid instanceof PoiCollection) {
            $this->txMaps2Uid = $txMaps2Uid;
        }
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
