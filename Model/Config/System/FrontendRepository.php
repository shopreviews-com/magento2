<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\System;

use Shopreviews\Connect\Api\Config\System\FrontendInterface;

/**
 * Class FrontendRepository
 */
class FrontendRepository extends BaseRepository implements FrontendInterface
{
    /**
     * @inheritDoc
     */
    public function isFrontendEnabled(?int $storeId = null): bool
    {
        return $this->isSetFlag(self::FRONTEND_ENABLE, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function getWebsite(): ?string
    {
        return $this->getStoreValue(self::WEBSITE) ?: null;
    }

    /**
     * @inheritDoc
     */
    public function getLayoutUpdate(): string
    {
        return $this->getStoreValue(self::FRONTEND_LAYOUT_UPDATE);
    }

    /**
     * @inheritDoc
     */
    public function getPageTitle(): string
    {
        return $this->getStoreValue(self::FRONTEND_META_TITLE);
    }

    /**
     * @inheritDoc
     */
    public function getMetaDescription(): string
    {
        return $this->getStoreValue(self::FRONTEND_META_DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function getMetaKeywords(): string
    {
        return $this->getStoreValue(self::FRONTEND_META_KEYWORDS);
    }

    /**
     * @inheritDoc
     */
    public function getReviewsPerPage(): string
    {
        return $this->getStoreValue(self::FRONTEND_PAGE);
    }

    /**
     * @inheritDoc
     */
    public function showStructuredData(?int $storeId = null): bool
    {
        return $this->isSetFlag(self::FRONTEND_STRUCTURED_DATA, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function getStorePhone(): string
    {
        return $this->getStoreValue(self::GENERAL_INFORMATION_PHONE);
    }

    /**
     * @inheritDoc
     */
    public function isRatingFilter(?int $storeId = null): bool
    {
        return $this->isSetFlag(self::FRONTEND_RATING_FILTER, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function isYearsFilter(?int $storeId = null): bool
    {
        return $this->isSetFlag(self::FRONTEND_YEARS_FILTER, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function isSourceFilter(?int $storeId = null): bool
    {
        return $this->isSetFlag(self::FRONTEND_SOURCE_FILTER, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function getDisplayRatings(): string
    {
        return $this->getStoreValue(self::ACCOUNT_RATING_VALUES);
    }

    /**
     * @inheritDoc
     */
    public function getUrlPath(): ?string
    {
        return !$this->isFrontendEnabled() ? null : $this->getStoreValue(self::URL_PATH) ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getReviewPageUrl(?int $storeId = null): ?string
    {
        return $this->getStore()->getBaseUrl() . $this->getUrlPath();
    }

    /**
     * @inheritDoc
     */
    public function getCompanyData(?int $storeId = null): array
    {
        return [
            'streetAddress' => $this->getStoreValue('general/store_information/street_line1'),
            'postalCode' => $this->getStoreValue('general/store_information/postcode'),
            'addressLocality' => $this->getStoreValue('general/store_information/city'),
            'addressCountry' => $this->getStoreValue('general/store_information/country_id'),
        ];
    }
}
