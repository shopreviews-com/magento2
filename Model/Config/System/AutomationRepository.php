<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\System;

use Shopreviews\Connect\Api\Config\System\AutomationInterface;

class AutomationRepository extends BaseRepository implements AutomationInterface
{
    /**
     * @inheritDoc
     */
    public function isCronEnabled(): bool
    {
        return $this->isSetFlag(self::CRON_STATUS);
    }
}
