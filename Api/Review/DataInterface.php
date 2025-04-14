<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Review;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Reviews object interface
 * @api
 */
interface DataInterface extends ExtensibleDataInterface
{

    /**
     * ID of review
     */
    public const REVIEW_UUID = 'review_uuid';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const DESCRIPTION = 'description';
    public const RATING = 'rating';
    public const SOURCE_UUID = 'source_uuid';
    public const PLATFORM_UUID = 'platform_uuid';
    public const COMPANY_UUID = 'company_uuid';
    public const REVIEW_DATE = 'review_date';
    public const LOCALE_CODE = 'locale_code';

    /**
     * Joined fields.
     */
    public const PLATFORM_NAME = 'platform_name';
    public const PLATFORM_LOGO = 'platform_logo';
    public const PLATFORM_ICON = 'platform_icon';

    /**
     * @return string
     */
    public function getReviewUuid(): string;

    /**
     * @param string $reviewUuid
     * @return $this
     */
    public function setReviewUuid(string $reviewUuid): self;

    /**
     * @return string
     */
    public function getSourceUuid(): string;

    /**
     * @param string $uuid
     * @return $this
     */
    public function setSourceUuid(string $uuid): self;

    /**
     * @return string
     */
    public function getPlatformUuid():string;

    /**
     * @param string $uuid
     * @return $this
     */
    public function setPlatformUuid(string $uuid): self;

    /**
     * @return string
     */
    public function getCompanyUuid(): string;

    /**
     * @param string $uuid
     * @return $this
     */
    public function setCompanyUuid(string $uuid): self;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self;

    /**
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * @param string|null $email
     * @return $this
     */
    public function setEmail(?string $email): self;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self;

    /**
     * @return int
     */
    public function getRating(): int;

    /**
     * @param int $rating
     * @return $this
     */
    public function setRating(int $rating): self;

    /**
     * @return string
     */
    public function getReviewDate(): string;

    /**
     * @param string $reviewDate
     * @return $this
     */
    public function setReviewDate(string $reviewDate): self;

    /**
     * @return string
     */
    public function getLocaleCode(): ?string;

    /**
     * @param string|null $localeCode
     * @return $this
     */
    public function setLocaleCode(?string $localeCode): self;

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
