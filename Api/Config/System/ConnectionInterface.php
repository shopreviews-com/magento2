<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Config\System;

/**
 * Connection Settings interface
 * @api
 */
interface ConnectionInterface extends FrontendInterface
{

    public const COMPANY_UUID = 'shopreviews_com/connection/company_uuid';
    public const ACCESS_TOKEN = 'shopreviews_com/connection/access_token';
    public const REFRESH_TOKEN = 'shopreviews_com/connection/refresh_token';
    public const TOKEN_CREATED_AT = 'shopreviews_com/connection/token_created_at';
    public const TOKEN_EXPIRE_AT = 'shopreviews_com/connection/token_expire_at';
    public const LAST_SYNCED = 'shopreviews_com/connection/last_synced';
    public const APP_NAME = 'shopreviews_com/connection/app_name';
    public const PLATFORM_TOKEN = 'shopreviews_com/connection/platform_token';

    /**
     * Retrieve the company UUID.
     *
     * @return string
     */
    public function getCompanyUuid(): string;

    /**
     * Retrieve the access token.
     *
     * @return string
     */
    public function getAccessToken(): string;

    /**
     * Get platform token
     *
     * @return string
     */
    public function getPlatformToken(): string;

    /**
     * Retrieve all credentials as an array.
     *
     * @return array
     */
    public function getCredentials(): array;

    /**
     * Retrieve the connected App Name
     *
     * @return string|null
     */
    public function getAppName(): ?string;

    /**
     * @return string|null
     */
    public function getLastSynced(): ?string;

    /**
     * @return void
     */
    public function setLastSynced(): void;

    /**
     * Update credentials if needed.
     *
     * @param array $credentials
     * @return void
     */
    public function updateCredentials(array $credentials): void;

    /**
     * @return void
     */
    public function resetCredentials():void;
}
