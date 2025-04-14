<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Selftest;

use Shopreviews\Connect\Api\Selftest\RepositoryInterface as SelftestRepositoryInterface;

/**
 * Selftest repository class
 */
class Repository implements SelftestRepositoryInterface
{

    private array $testList;

    public function __construct(
        $testList
    ) {
        $this->testList = $testList;
    }

    /**
     * @inheritDoc
     */
    public function test($output = true): array
    {
        $result = [];
        foreach ($this->testList as $data) {
            $result[] = $data->execute();
        }
        return $result;
    }
}
