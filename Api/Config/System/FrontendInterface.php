<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Config\System;

/**
 * Frontend Settings interface
 * @api
 */
interface FrontendInterface extends AutomationInterface
{
    public const FRONTEND_ENABLE = 'shopreviews_com/frontend/enable';
    public const WEBSITE = 'shopreviews_com/frontend/website';
    public const URL_PATH = 'shopreviews_com/frontend/url';
    public const FRONTEND_RATING_FILTER = 'shopreviews_com/frontend/rating_filter';
    public const ACCOUNT_RATING_VALUES = 'shopreviews_com/frontend/rating_values';
    public const FRONTEND_YEARS_FILTER = 'shopreviews_com/frontend/years_filter';
    public const FRONTEND_SOURCE_FILTER = 'shopreviews_com/frontend/source_filter';
    public const FRONTEND_LAYOUT_UPDATE = 'shopreviews_com/frontend/layout_update';
    public const FRONTEND_META_TITLE = 'shopreviews_com/frontend/meta_title';
    public const FRONTEND_META_DESCRIPTION = 'shopreviews_com/frontend/meta_description';
    public const FRONTEND_META_KEYWORDS = 'shopreviews_com/frontend/meta_keywords';
    public const FRONTEND_PAGE = 'shopreviews_com/frontend/page';
    public const FRONTEND_STRUCTURED_DATA = 'shopreviews_com/frontend/structured_data';

    public const GENERAL_INFORMATION_PHONE = 'general/store_information/phone';

    /**
     * Check if frontend section enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isFrontendEnabled(?int $storeId = null): bool;

    /**
     * Returns selected website
     *
     * @return array|null
     */
    public function getWebsite(): ?string;

    /**
     * Returns layout config value
     *
     * @return string
     */
    public function getLayoutUpdate(): string;

    /**
     * Returns page title
     *
     * @return string
     */
    public function getPageTitle(): string;

    /**
     * Returns meta description
     *
     * @return string
     */
    public function getMetaDescription(): string;

    /**
     * Returns meta keywords
     *
     * @return string
     */
    public function getMetaKeywords(): string;

    /**
     * Returns reviews per page value
     *
     * @return string
     */
    public function getReviewsPerPage(): string;

    /**
     * Check if generate structure data is enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function showStructuredData(?int $storeId = null): bool;

    /**
     * Get current store phone number
     *
     * @return string
     */
    public function getStorePhone(): string;

    /**
     * Check if ratings filter enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isRatingFilter(?int $storeId = null): bool;

    /**
     * Check if years filter enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isYearsFilter(?int $storeId = null): bool;

    /**
     * Check if source filter enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isSourceFilter(?int $storeId = null): bool;

    /**
     * Returns selected reviews score to display
     *
     * @return string
     */
    public function getDisplayRatings(): string;

    /**
     * @return string|null
     */
    public function getUrlPath(): ?string;

    /**
     * @param int|null $storeId
     * @return string|null
     */
    public function getReviewPageUrl(?int $storeId = null): ?string;

    /**
     * @param int|null $storeId
     * @return array
     */
    public function getCompanyData(?int $storeId = null): array;
}
