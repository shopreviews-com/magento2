<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Request;

use Magento\Framework\Exception\LocalizedException;
use Shopreviews\Connect\Api\Request\RepositoryInterface as RequestRepositoryInterface;
use Shopreviews\Connect\Service\Platform\Sync as SyncPlatform;
use Shopreviews\Connect\Service\Review\Sync as SyncReview;
use Shopreviews\Connect\Service\Source\Sync as SyncSource;
use Shopreviews\Connect\Service\Website\Sync as SyncWebsite;

class Repository implements RequestRepositoryInterface
{

    private const TYPES = ['website', 'source', 'platform', 'review', 'totals'];

    private SyncWebsite $syncWebsite;
    private SyncSource $syncSource;
    private SyncPlatform $syncPlatform;
    private SyncReview $syncReview;

    public function __construct(
        SyncWebsite $syncWebsite,
        SyncSource $syncSource,
        SyncPlatform $syncPlatform,
        SyncReview $syncReview
    ) {
        $this->syncWebsite = $syncWebsite;
        $this->syncSource = $syncSource;
        $this->syncPlatform = $syncPlatform;
        $this->syncReview = $syncReview;
    }

    /**
     * @inheritDoc
     */
    public function syncAll(): array
    {
        return $this->syncByTypes(self::TYPES);
    }

    /**
     * @inheritDoc
     */
    public function syncIncremental(): array
    {
        //TODO
        return [];
    }

    /**
     * @inheritDoc
     */
    public function syncByTypes(array $types): array
    {
        $result = [];

        foreach ($types as $type) {
            try {
                $result[$type] = $this->syncByType($type);
            } catch (\Exception $exception) {
                $result[$type] = ['error' => $exception->getMessage()];
            }
        }

        return ['multi' => array_filter($result)];
    }

    /**
     * @param string $type
     * @return array|null
     * @throws LocalizedException
     */
    private function syncByType(string $type): ?array
    {
        if ($type == 'website') {
            return $this->syncWebsite->execute();
        }

        if ($type == 'source') {
            return $this->syncSource->execute();
        }

        if ($type == 'platform') {
            return $this->syncPlatform->execute();
        }

        if ($type == 'review') {
            return $this->syncReview->execute();
        }

        return null;
    }
}
