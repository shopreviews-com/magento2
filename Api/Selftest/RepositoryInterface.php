<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Selftest;

/**
 * Self test repository interface
 * @api
 */
interface RepositoryInterface
{

    /**
     * Test everything
     *
     * @return array
     */
    public function test(): array;
}
