<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Source;

use Magento\Framework\Exception\AuthenticationException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shopreviews\Connect\Api\Source\DataInterface as SourceData;
use Shopreviews\Connect\Api\Source\RepositoryInterface as SourceRepository;
use Shopreviews\Connect\Service\Api\Adapter;
use Shopreviews\Connect\Service\Platform\Sync as SyncPlatforms;

class Sync
{

    public int $updated = 0;
    public int $new = 0;
    private Adapter $adapter;
    private SourceRepository $sourceRepository;
    private SyncPlatforms $syncPlatforms;

    public function __construct(
        Adapter $adapter,
        SourceRepository $sourceRepository,
        SyncPlatforms $syncPlatforms
    ) {
        $this->adapter = $adapter;
        $this->sourceRepository = $sourceRepository;
        $this->syncPlatforms = $syncPlatforms;
    }

    /**
     * @throws LocalizedException
     */
    public function execute(): array
    {
        $this->syncPlatforms->execute();
        $sources = $this->getSources();

        foreach ($sources['data'] as $sourceData) {
            $source = $this->loadSavedSource($sourceData['uuid'])
                ->setName($sourceData['name'])
                ->setLogoUrl($sourceData['logo'])
                ->setUrl($sourceData['url'])
                ->setReviewLink($sourceData['review_link'])
                ->setCompanyUuid($sourceData['company_uuid'])
                ->setPlatformUuid($sourceData['platform_uuid'])
                ->setWebsiteUuids($sourceData['website_uuids'])
                ->setReviewCount($sourceData['total_reviews'])
                ->setAvgRating((float)($sourceData['overview_summary']['avg_rating'] ?? 0))
                ->setLastSyncedAt($sourceData['last_sync_at'])
                ->setNextSyncAt($sourceData['next_sync_at'])
                ->setCreatedAt($sourceData['created_at'])
                ->setUpdatedAt($sourceData['updated_at']);

            $this->sourceRepository->save($source);
        }

        return [
            'success' => true,
            'new' => $this->new,
            'updated' => $this->updated
        ];
    }

    /**
     * @return array
     * @throws LocalizedException
     * @throws AuthenticationException
     */
    private function getSources(): array
    {
        return $this->adapter->execute(Adapter::API_SOURCES);
    }

    /**
     * @param string $sourceUuid
     * @return SourceData
     * @throws LocalizedException
     */
    private function loadSavedSource(string $sourceUuid): SourceData
    {
        try {
            $source = $this->sourceRepository->getByUuid($sourceUuid);
            $this->updated++;
        } catch (NoSuchEntityException $exception) {
            $source = $this->sourceRepository->create()->setSourceUuid($sourceUuid);
            $this->new++;
        }
        return $source;
    }
}
