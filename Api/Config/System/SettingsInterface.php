<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Config\System;

/**
 * Config Settings interface
 * @api
 */
interface SettingsInterface extends ConnectionInterface
{

    public const EXTENSION_ENABLE = 'shopreviews_com/general/enable';
    public const DEBUG_ENABLE = 'shopreviews_com/debug/active';

    /**
     * Check if module is enabled
     *
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * Check if debug mode is enabled
     *
     * @return bool
     */
    public function isDebugMode(): bool;
}
