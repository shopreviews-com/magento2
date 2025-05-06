<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Config\System;

/**
 * Automation interface
 * @api
 */
interface AutomationInterface
{
    public const CRON_STATUS = 'shopreviews_com/automation/cron';

    /**
     * Check if Cron is enabled
     * @return bool
     */
    public function isCronEnabled(): bool;
}
