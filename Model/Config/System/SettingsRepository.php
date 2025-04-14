<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\System;

use Shopreviews\Connect\Api\Config\System\SettingsInterface;

/**
 * Config Settings provider class
 */
class SettingsRepository extends ConnectionRepository implements SettingsInterface
{

    /**
     * @inheritDoc
     */
    public function isEnabled(): bool
    {
        return $this->isSetFlag(static::EXTENSION_ENABLE);
    }

    /**
     * @inheritDoc
     */
    public function isDebugMode(): bool
    {
        return $this->isSetFlag(static::DEBUG_ENABLE);
    }
}
