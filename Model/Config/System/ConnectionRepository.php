<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\System;

use Magento\Framework\App\Cache\Type\Config;
use Shopreviews\Connect\Api\Config\System\ConnectionInterface;

/**
 * Config Settings Provider Class
 */
class ConnectionRepository extends FrontendRepository implements ConnectionInterface
{

    /**
     * @inheritDoc
     */
    public function getCompanyUuid(): string
    {
        return $this->getStoreValue(self::COMPANY_UUID);
    }

    /**
     * @inheritDoc
     */
    public function getAccessToken(): string
    {
        return $this->getStoreValue(self::ACCESS_TOKEN);
    }

    /**
     * @return string
     */
    private function getRefreshToken(): string
    {
        return $this->getStoreValue(self::REFRESH_TOKEN);
    }

    /**
     * @return string
     */
    private function getTokenCreatedAt(): string
    {
        return $this->getStoreValue(self::TOKEN_CREATED_AT);
    }

    /**
     * @return string
     */
    private function getTokenExpireAt(): string
    {
        return $this->getStoreValue(self::TOKEN_EXPIRE_AT);
    }

    /**
     * @inheritDoc
     */
    public function getAppName(): ?string
    {
        return $this->getStoreValue(self::APP_NAME);
    }

    /**
     * @inheritDoc
     */
    public function getLastSynced(): ?string
    {
        return $this->getUncachedConfigValue(self::LAST_SYNCED);
    }

    /**
     * @inheritDoc
     */
    public function setLastSynced(): void
    {
        $this->setConfigData($this->date->gmtDate(), self::LAST_SYNCED, 0);
    }

    /**
     * @inheritDoc
     */
    public function getCredentials(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'refresh_token' => $this->getRefreshToken(),
            'token_created_at' => $this->getTokenCreatedAt(),
            'token_expire_at' => $this->getTokenExpireAt(),
            'company_uuid' => $this->getCompanyUuid(),
            'app_name' => $this->getAppName(),
            'platform_token' => $this->getPlatformToken(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function updateCredentials(array $credentials): void
    {
        $needsUpdate = false;
        $currentCredentials = $this->getCredentials();

        foreach ($credentials as $key => $value) {
            if (!isset($currentCredentials[$key]) || $currentCredentials[$key] !== $value) {
                $this->setConfigData($value, "shopreviews_com/connection/{$key}");
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            $this->setConfigData('1', 'shopreviews_com/general/enable');
            $this->flushCache();
        }
    }

    /**
     * @inheritDoc
     */
    public function resetCredentials(): void
    {
        $currentCredentials = $this->getCredentials();
        foreach ($currentCredentials as $key => $value) {
            $this->setConfigData(null, "shopreviews_com/connection/{$key}");
        }

        $this->setConfigData(null, self::LAST_SYNCED);
        $this->flushCache();
    }

    /**
     * @inheritDoc
     */
    public function getPlatformToken(): string
    {
        $token = $this->getUncachedConfigValue(self::PLATFORM_TOKEN);
        if (!$token) {
            $token = $this->random->getRandomString(32);
            $this->setConfigData($token, self::PLATFORM_TOKEN);
        }

        return $token;
    }

    /**
     * Flush configuration cache to ensure updates are effective.
     *
     * @return void
     */
    private function flushCache(): void
    {
        // Clear runtime cache for configuration
        $this->appConfig->clean();
        // Invalidate config cache to ensure updated values are used
        $this->cacheManager->invalidate(Config::TYPE_IDENTIFIER);
    }

}

