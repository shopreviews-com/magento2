<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Request;

/**
 * Request repository interface
 * @api
 */
interface RepositoryInterface
{
    /**
     * Sync all data from platform
     * @return array
     */
    public function syncAll(): array;

    /**
     * Sync all new data from platform
     * @return array
     */
    public function syncIncremental(): array;

    /**
     * Sync data from platform by type
     * @param array $types
     * @return array
     */
    public function syncByTypes(array $types): array;
}
