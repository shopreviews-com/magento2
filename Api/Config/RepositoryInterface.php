<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Config;

use Magento\Store\Api\Data\StoreInterface;

/**
 * Config repository interface
 */
interface RepositoryInterface extends System\SettingsInterface
{

    public const EXTENSION_CODE = 'Shopreviews_Connect';
    public const EXTENSION_VERSION = 'shopreviews_com/general/version';

    /**
     * Get extension version
     *
     * @return string
     */
    public function getExtensionVersion(): string;

    /**
     * Get extension code
     *
     * @return string
     */
    public function getExtensionCode(): string;

    /**
     * Get Magento Version
     *
     * @return string
     */
    public function getMagentoVersion(): string;

    /**
     * Get current store
     *
     * @return StoreInterface
     */
    public function getStore(): StoreInterface;
}
