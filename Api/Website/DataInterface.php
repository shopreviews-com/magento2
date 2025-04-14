<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Website;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Websites object interface
 * @api
 */
interface DataInterface extends ExtensibleDataInterface
{

    /**
     * Constants for keys of data array.
     */
    public const WEBSITE_UUID = 'website_uuid';
    public const COMPANY_UUID = 'company_uuid';
    public const NAME = 'name';
    public const LOGO_URL = 'logo_url';
    public const DETAILS = 'details';
    public const BEST_RATING = 'best_rating';
    public const WORST_RATING = 'worst_rating';
    public const REVIEW_COUNT = 'review_count';
    public const AVG_RATING = 'avg_rating';
    public const SOURCE_COUNT = 'source_count';
    public const IS_ACTIVE = 'is_active';
    public const SCORE_SUMMARY = 'score_summary';
    public const CREATED_AT = 'platform_created_at';
    public const UPDATED_AT = 'platform_updated_at';

    /**
     * @return string
     */
    public function getWebsiteUuid(): string;

    /**
     * @param string $websiteUuid
     * @return $this
     */
    public function setWebsiteUuid(string $websiteUuid): self;

    /**
     * @return string
     */
    public function getCompanyUuid(): string;

    /**
     * @param string $companyUuid
     * @return $this
     */
    public function setCompanyUuid(string $companyUuid): self;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self;

    /**
     * @return string|null
     */
    public function getLogo(): ?string;

    /**
     * @param string|null $logo
     * @return $this
     */
    public function setLogo(?string $logo): self;

    /**
     * @return string|null
     */
    public function getDetails(): ?string;

    /**
     * @param string|null $details
     * @return $this
     */
    public function setDetails(?string $details): self;

    /**
     * @return int
     */
    public function getReviewCount(): int;

    /**
     * @param int $count
     * @return $this
     */
    public function setReviewCount(int $count): self;

    /**
     * @return float|null
     */
    public function getAvgRating(): ?float;

    /**
     * @param float|null $rating
     * @return $this
     */
    public function setAvgRating(?float $rating): self;

    /**
     * @return int
     */
    public function getBestRating(): int;

    /**
     * @param int $rating
     * @return $this
     */
    public function setBestRating(int $rating): self;

    /**
     * @return int
     */
    public function getWorstRating(): int;

    /**
     * @param int $rating
     * @return $this
     */
    public function setWorstRating(int $rating): self;

    /**
     * @return int|null
     */
    public function getSourceCount(): int;

    /**
     * @param int|null $count
     * @return $this
     */
    public function setSourceCount(int $count): self;

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @param bool $active
     * @return $this
     */
    public function setIsActive(bool $active): self;

    /**
     * @return array|null
     */
    public function getScoreSummary(): ?array;

    /**
     * @param array|null $summary
     * @return $this
     */
    public function setScoreSummary(?array $summary): self;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * @param string|null $date
     * @return $this
     */
    public function setUpdatedAt(?string $date): self;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param string|null $date
     * @return $this
     */
    public function setCreatedAt(?string $date): self;
}
