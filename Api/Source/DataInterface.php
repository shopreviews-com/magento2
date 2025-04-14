<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Source;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Sources object interface
 * @api
 */
interface DataInterface extends ExtensibleDataInterface
{

    /**
     * Constants for keys of data array.
     */
    public const SOURCE_UUID = 'source_uuid';
    public const NAME = 'name';
    public const LOGO_URL = 'logo_url';
    public const URL = 'url';
    public const REVIEW_LINK = 'review_link';
    public const COMPANY_UUID = 'company_uuid';
    public const PLATFORM_UUID = 'platform_uuid';
    public const WEBSITE_UUIDS = 'website_uuids';
    public const REVIEW_COUNT = 'review_count';
    public const AVG_RATING = 'avg_rating';
    public const LAST_SYNCED_AT = 'last_sync_at';
    public const NEXT_SYNC_AT = 'next_sync_at';
    public const UPDATED_AT = 'platform_created_at';
    public const CREATED_AT = 'platform_updated_at';

    /**
     * Joined fields.
     */
    public const PLATFORM_NAME = 'platform_name';
    public const PLATFORM_LOGO = 'platform_logo';
    public const PLATFORM_ICON = 'platform_icon';

    /**
     * @return string
     */
    public function getSourceUuid(): string;

    /**
     * @param string $sourceUuid
     * @return $this
     */
    public function setSourceUuid(string $sourceUuid): self;

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
    public function getLogoUrl(): ?string;

    /**
     * @param string|null $url
     * @return $this
     */
    public function setLogoUrl(?string $url): self;

    /**
     * @return string|null
     */
    public function getUrl(): ?string;

    /**
     * @param string|null $url
     * @return $this
     */
    public function setUrl(?string $url): self;

    /**
     * @return string|null
     */
    public function getReviewLink(): ?string;

    /**
     * @param string|null $url
     * @return $this
     */
    public function setReviewLink(?string $url): self;

    /**
     * @return string|null
     */
    public function getCompanyUuid(): ?string;

    /**
     * @param string|null $uuid
     * @return $this
     */
    public function setCompanyUuid(?string $uuid): self;

    /**
     * @return string|null
     */
    public function getPlatformUuid(): ?string;

    /**
     * @param string|null $uuid
     * @return $this
     */
    public function setPlatformUuid(?string $uuid): self;

    /**
     * @return array|null
     */
    public function getWebsiteUuids(): ?array;

    /**
     * @param array|null $uuids
     * @return $this
     */
    public function setWebsiteUuids(?array $uuids): self;

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
     * @return string|null
     */
    public function getLastSyncedAt(): ?string;

    /**
     * @param string|null $date
     * @return $this
     */
    public function setLastSyncedAt(?string $date): self;

    /**
     * @return string|null
     */
    public function getNextSyncAt(): ?string;

    /**
     * @param string|null $date
     * @return $this
     */
    public function setNextSyncAt(?string $date): self;

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

    /**
     * @return string|null
     */
    public function getPlatformName(): ?string;

    /**
     * @return string|null
     */
    public function getPlatformLogo(): ?string;

    /**
     * @return string|null
     */
    public function getPlatformIcon(): ?string;
}
