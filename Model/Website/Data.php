<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Website;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Model\AbstractModel;
use Shopreviews\Connect\Api\Website\DataInterface as ShopreviewsWebsiteData;
use Shopreviews\Connect\Model\Website\ResourceModel as ShopreviewsWebsiteResource;

/**
 * Shopreview website data class
 */
class Data extends AbstractModel implements ExtensibleDataInterface, ShopreviewsWebsiteData
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(ShopreviewsWebsiteResource::class);
    }

    /**
     * @inheritDoc
     */
    public function getWebsiteUuid(): string
    {
        return (string)$this->getData(self::WEBSITE_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setWebsiteUuid(string $websiteUuid): ShopreviewsWebsiteData
    {
        return $this->setData(self::WEBSITE_UUID, $websiteUuid);
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
    public function setCompanyUuid(string $companyUuid): ShopreviewsWebsiteData
    {
        return $this->setData(self::COMPANY_UUID, $companyUuid);
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(?string $name): ShopreviewsWebsiteData
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getDetails(): ?string
    {
        return $this->getData(self::DETAILS);
    }

    /**
     * @inheritDoc
     */
    public function setDetails(?string $details): ShopreviewsWebsiteData
    {
        return $this->setData(self::DETAILS, $details);
    }

    /**
     * @inheritDoc
     */
    public function getReviewCount(): int
    {
        return (int)$this->getData(self::REVIEW_COUNT);
    }

    /**
     * @inheritDoc
     */
    public function setReviewCount(int $count): ShopreviewsWebsiteData
    {
        return $this->setData(self::REVIEW_COUNT, $count);
    }

    /**
     * @inheritDoc
     */
    public function getAvgRating(): ?float
    {
        $rating = $this->getData(self::AVG_RATING);

        if ($rating === null) {
            return null;
        }

        $rating = (float)$rating;

        // If the rating has a decimal part, round it to 1 decimal place
        return ($rating == floor($rating)) ? round($rating, 0) : round($rating, 1);
    }

    /**
     * @inheritDoc
     */
    public function setAvgRating(?float $rating): ShopreviewsWebsiteData
    {
        return $this->setData(self::AVG_RATING, $rating);
    }

    /**
     * @inheritDoc
     */
    public function getSourceCount(): int
    {
        return (int)$this->getData(self::SOURCE_COUNT);
    }

    /**
     * @inheritDoc
     */
    public function setSourceCount(int $count): ShopreviewsWebsiteData
    {
        return $this->setData(self::SOURCE_COUNT, $count);
    }

    /**
     * @inheritDoc
     */
    public function getIsActive(): bool
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(bool $active): ShopreviewsWebsiteData
    {
        return $this->setData(self::IS_ACTIVE, $active);
    }

    /**
     * @inheritDoc
     */
    public function getScoreSummary(): ?array
    {
        return $this->getData(self::SCORE_SUMMARY);
    }

    /**
     * @inheritDoc
     */
    public function setScoreSummary(?array $summary): ShopreviewsWebsiteData
    {
        return $this->setData(self::SCORE_SUMMARY, $summary);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(?string $date): ShopreviewsWebsiteData
    {
        return $this->setData(self::UPDATED_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(?string $date): ShopreviewsWebsiteData
    {
        return $this->setData(self::CREATED_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function getLogo(): ?string
    {
        return $this->getData(self::LOGO_URL);
    }

    /**
     * @inheritDoc
     */
    public function setLogo(?string $logo): ShopreviewsWebsiteData
    {
        return $this->setData(self::LOGO_URL, $logo);
    }

    /**
     * @inheritDoc
     */
    public function getBestRating(): int
    {
        return (int)$this->getData(self::BEST_RATING);
    }

    /**
     * @inheritDoc
     */
    public function setBestRating(int $rating): ShopreviewsWebsiteData
    {
        return $this->setData(self::BEST_RATING, $rating);
    }

    /**
     * @inheritDoc
     */
    public function getWorstRating(): int
    {
        return (int)$this->getData(self::WORST_RATING);
    }

    /**
     * @inheritDoc
     */
    public function setWorstRating(int $rating): ShopreviewsWebsiteData
    {
        return $this->setData(self::WORST_RATING, $rating);
    }
}
