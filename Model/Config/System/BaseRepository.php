<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\System;

use Exception;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\Math\Random;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\Config as AppConfig;

/**
 * Config repository class
 */
class BaseRepository
{

    protected StoreManagerInterface $storeManager;
    protected ProductMetadataInterface $metadata;
    protected TypeListInterface $cacheManager;
    protected EncryptorInterface $encryptor;
    protected Random $random;
    protected DateTime $date;
    protected AppConfig $appConfig;

    private ScopeConfigInterface $scopeConfig;
    private WriterInterface $resourceConfig;
    private ResourceConnection $resource;

    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        WriterInterface $resourceConfig,
        ProductMetadataInterface $metadata,
        ResourceConnection $resource,
        TypeListInterface $cacheManager,
        EncryptorInterface $encryptor,
        Random $random,
        DateTime $date,
        AppConfig $appConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->resourceConfig = $resourceConfig;
        $this->metadata = $metadata;
        $this->resource = $resource;
        $this->cacheManager = $cacheManager;
        $this->encryptor = $encryptor;
        $this->random = $random;
        $this->date = $date;
        $this->appConfig = $appConfig;
    }

    /**
     * Get config value flag
     *
     * @param string $path
     * @param int|null $storeId
     * @param string|null $scope
     *
     * @return bool
     */
    protected function isSetFlag(string $path, ?int $storeId = null, ?string $scope = null): bool
    {
        if (empty($scope)) {
            $scope = ScopeInterface::SCOPE_STORE;
        }

        if (empty($storeId)) {
            $storeId = $this->getStore()->getId();
        }

        return $this->scopeConfig->isSetFlag($path, $scope, $storeId);
    }

    /**
     * @param $storeId
     * @return StoreInterface
     */
    public function getStore($storeId = null): StoreInterface
    {
        try {
            return $this->storeManager->getStore($storeId);
        } catch (Exception $e) {
            if ($store = $this->storeManager->getDefaultStoreView()) {
                return $store;
            }
        }
        $stores = $this->storeManager->getStores();
        return reset($stores);
    }

    /**
     * Get Configuration data
     *
     * @param string $path
     * @param int|null $storeId
     * @param string|null $scope
     *
     * @return string
     */
    protected function getStoreValue(
        string $path,
        ?int $storeId = null,
        ?string $scope = null
    ): string {
        $storeId = $storeId ?: $this->getStore()->getId();
        $scope = $scope ?? ScopeInterface::SCOPE_STORE;
        return (string)$this->scopeConfig->getValue($path, $scope, (int)$storeId);
    }

    /**
     * Set Config data
     *
     * @param string|null $value
     * @param string $key
     * @param int|null $storeId
     * @return void
     */
    protected function setConfigData(?string $value, string $key, ?int $storeId = null): void
    {
        if ($storeId) {
            $this->resourceConfig->save($key, $value, 'stores', (int)$storeId);
        } else {
            $this->resourceConfig->save($key, $value, 'default', 0);
        }
    }

    /**
     * Fetch uncached config value directly from core_config_data table.
     *
     * @param string $path
     * @return string|null
     */
    protected function getUncachedConfigValue(string $path): ?string
    {
        $connection = $this->resource->getConnection();
        $select = $connection->select()
            ->from($this->resource->getTableName('core_config_data'), ['value'])
            ->where('path = ?', $path)
            ->where('scope = ?', 'default')
            ->where('scope_id = ?', 0);

        return $connection->fetchOne($select) ?: null;
    }
}
