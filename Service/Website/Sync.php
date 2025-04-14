<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Website;

use Magento\Framework\Exception\AuthenticationException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shopreviews\Connect\Api\Website\DataInterface as WebsiteData;
use Shopreviews\Connect\Api\Website\RepositoryInterface as WebsiteRepository;
use Shopreviews\Connect\Service\Api\Adapter;

class Sync
{

    public int $updated = 0;
    public int $new = 0;

    private Adapter $adapter;
    private WebsiteRepository $websiteRepository;

    public function __construct(
        Adapter $adapter,
        WebsiteRepository $websiteRepository
    ) {
        $this->adapter = $adapter;
        $this->websiteRepository = $websiteRepository;
    }

    /**
     * @throws LocalizedException
     */
    public function execute(): array
    {
        $websites = $this->getWebsites();
        foreach ($websites['data'] as $websiteData) {
            $website = $this->loadSavedWebsite($websiteData['uuid'])
                ->setName($websiteData['name'])
                ->setLogo($websiteData['logo_url'])
                ->setCompanyUuid($websiteData['company_uuid'])
                ->setDetails($websiteData['details'])
                ->setScoreSummary($websiteData['score_summary'])
                ->setAvgRating($websiteData['avg_ratings'])
                ->setReviewCount($websiteData['review_count'])
                ->setSourceCount($websiteData['source_count'])
                ->setBestRating((int)$websiteData['best_rating'] ?? 5)
                ->setWorstRating((int)$websiteData['worst_rating'] ?? 0)
                ->setIsActive((bool)$websiteData['is_active'])
                ->setUpdatedAt($websiteData['updated_at'])
                ->setCreatedAt($websiteData['created_at']);

            $this->websiteRepository->save($website);
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
    private function getWebsites(): array
    {
        return $this->adapter->execute(Adapter::API_WEBSITES);
    }

    /**
     * @param string $websiteUuid
     * @return WebsiteData
     * @throws LocalizedException
     */
    private function loadSavedWebsite(string $websiteUuid): WebsiteData
    {
        try {
            $website = $this->websiteRepository->getByUuid($websiteUuid);
            $this->updated++;
        } catch (NoSuchEntityException $exception) {
            $website = $this->websiteRepository->create()->setWebsiteUuid($websiteUuid);
            $this->new++;
        }
        return $website;
    }
}
