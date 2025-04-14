<?php
/**
 * Copyright © Shopreviews.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Api;

use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;
use Shopreviews\Connect\Api\Website\DataInterface as WebsiteData;
use Shopreviews\Connect\Api\Website\RepositoryInterface as WebsiteRepository;
use Shopreviews\Connect\Service\Schema\MarkupGenerator;
use Shopreviews\Connect\Api\Service\RatingDataInterface;

class RatingInfo implements RatingDataInterface
{

    private ?WebsiteData $website = null;
    private MarkupGenerator $markupGenerator;
    private WebsiteRepository $websiteRepository;
    private ConfigRepository $configRepository;

    public function __construct(
        MarkupGenerator $markupGenerator,
        WebsiteRepository $websiteRepository,
        ConfigRepository $configRepository

    ) {
        $this->markupGenerator = $markupGenerator;
        $this->websiteRepository = $websiteRepository;
        $this->configRepository = $configRepository;
    }

    /**
     * @return array
     */
    public function getRatingInfo(): array
    {
        $website = $this->getWebsite();
        return $this->markupGenerator->generateStructuredData($website, []);
    }

    /**
     * Retrieve sources for the set Website
     */
    public function getWebsite(): ?WebsiteData
    {
        if ($this->website === null) {
            try {
                $this->website = $this->websiteRepository->getByUuid($this->configRepository->getWebsite());
            } catch (\Exception $exception) {
                return null;
            }
        }

        return $this->website;
    }
}
