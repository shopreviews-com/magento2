<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config;

use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepositoryInterface;

/**
 * Config repository class
 */
class Repository extends System\SettingsRepository implements ConfigRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getExtensionVersion(): string
    {
        return preg_replace(
            "/[^0-9.]/",
            '',
            (string)$this->getStoreValue(self::EXTENSION_VERSION)
        );
    }

    /**
     * @inheritDoc
     */
    public function getExtensionCode(): string
    {
        return self::EXTENSION_CODE;
    }

    /**
     * @inheritDoc
     */
    public function getMagentoVersion(): string
    {
        return $this->metadata->getVersion();
    }
}
