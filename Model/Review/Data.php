<?php
declare(strict_types=1);
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Shopreviews\Connect\Model\Review;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Model\AbstractModel;
use Shopreviews\Connect\Api\Review\DataInterface as ShopreviewsReviewData;
use Shopreviews\Connect\Model\Review\ResourceModel as ShopreviewsReviewResource;

/**
 * Shopreview review data class
 */
class Data extends AbstractModel implements ExtensibleDataInterface, ShopreviewsReviewData
{

    /**
     * @inheritDoc
     */
    public function _construct(): void
    {
        $this->_init(ShopreviewsReviewResource::class);
    }

    /**
     * @inheritDoc
     */
    public function getReviewUuid(): string
    {
        return (string)$this->getData(self::REVIEW_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setReviewUuid(string $reviewUuid): ShopreviewsReviewData
    {
        return $this->setData(self::REVIEW_UUID, $reviewUuid);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return (string)$this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): ShopreviewsReviewData
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): ?string
    {
        return (string)$this->getData(self::EMAIL) ?? null;
    }

    /**
     * @inheritDoc
     */
    public function setEmail(?string $email): ShopreviewsReviewData
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return (string)$this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): ShopreviewsReviewData
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getRating(): int
    {
        return (int)$this->getData(self::RATING);
    }

    /**
     * @inheritDoc
     */
    public function setRating(int $rating): ShopreviewsReviewData
    {
        return $this->setData(self::RATING, $rating);
    }

    /**
     * @inheritDoc
     */
    public function getSourceUuid(): string
    {
        return $this->getData(self::SOURCE_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setSourceUuid(?string $uuid): ShopreviewsReviewData
    {
        return $this->setData(self::SOURCE_UUID, $uuid);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformUuid(): string
    {
        return $this->getData(self::PLATFORM_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setPlatformUuid(?string $uuid): ShopreviewsReviewData
    {
        return $this->setData(self::PLATFORM_UUID, $uuid);
    }

    /**
     * @inheritDoc
     */
    public function getCompanyUuid(): string
    {
        return $this->getData(self::COMPANY_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setCompanyUuid(?string $uuid): ShopreviewsReviewData
    {
        return $this->setData(self::COMPANY_UUID, $uuid);
    }

    /**
     * @inheritDoc
     */
    public function getReviewDate(): string
    {
        return (string)$this->getData(self::REVIEW_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setReviewDate(string $reviewDate): ShopreviewsReviewData
    {
        return $this->setData(self::REVIEW_DATE, $reviewDate);
    }

    /**
     * @inheritDoc
     */
    public function getLocaleCode(): ?string
    {
        return $this->getData(self::LOCALE_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setLocaleCode(?string $localeCode): ShopreviewsReviewData
    {
        return $this->setData(self::LOCALE_CODE, $localeCode);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformName(): ?string
    {
        return $this->getData(self::PLATFORM_NAME);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformLogo(): ?string
    {
        return $this->getData(self::PLATFORM_LOGO);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformIcon(): ?string
    {
        return $this->getData(self::PLATFORM_ICON);
    }
}
