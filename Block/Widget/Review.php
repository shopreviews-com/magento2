<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Widget;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Shopreviews\Connect\Api\Review\RepositoryInterface as ReviewRepository;
use Shopreviews\Connect\Api\Source\DataInterface as SourceData;
use Shopreviews\Connect\Api\Source\RepositoryInterface as SourceRepository;
use Shopreviews\Connect\Api\Website\DataInterface as WebsiteData;
use Shopreviews\Connect\Api\Website\RepositoryInterface as WebsiteRepository;
use Shopreviews\Connect\Model\Review\Collection as ReviewCollection;
use Shopreviews\Connect\Model\Source\Collection as SourceCollection;
use Shopreviews\Connect\Service\Tools\Formatter;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;

/**
 * Block for review widget
 */
class Review extends Template implements BlockInterface
{

    public ?ReviewCollection $reviews = null;
    public ?SourceCollection $sources = null;
    public ?WebsiteData $website = null;

    private SourceRepository $sourceRepository;
    private ReviewRepository $reviewRepository;
    private WebsiteRepository $websiteRepository;
    private UrlInterface $urlBuilder;
    private LogRepository $logRepository;
    private Formatter $formatter;

    public function __construct(
        Template\Context $context,
        SourceRepository $sourceRepository,
        WebsiteRepository $websiteRepository,
        ReviewRepository $reviewRepository,
        LogRepository $logRepository,
        Formatter $formatter,
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        $this->sourceRepository = $sourceRepository;
        $this->reviewRepository = $reviewRepository;
        $this->websiteRepository = $websiteRepository;
        $this->logRepository = $logRepository;
        $this->formatter = $formatter;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * @return int
     */
    public function getUniqueId(): int
    {
        return rand();
    }

    /**
     * @param int|null $limit
     * @return ReviewCollection
     */
    public function getReviews(?int $limit = 10): ReviewCollection
    {
        if ($this->reviews === null) {
            $sourceUuids = $this->getSources()->getColumnValues(SourceData::SOURCE_UUID);
            $limit = $this->getData('max_reviews_number') ?? $limit;
            $this->reviews = $this->reviewRepository->getTopReviewsBySources($sourceUuids, (int)$limit);
        }

        return $this->reviews;
    }

    /**
     * @return ?SourceCollection
     */
    public function getSources(): ?SourceCollection
    {
        if ($this->sources === null) {
            $websiteUuid = $this->getWebsite()->getWebsiteUuid();
            $this->sources = $this->sourceRepository->getByWebsite($websiteUuid);
        }

        return $this->sources;
    }

    /**
     * @return WebsiteData|null
     */
    public function getWebsite(): ?WebsiteData
    {
        if ($this->website === null) {
            try {
                $website = !empty($this->getData('website')) ? $this->getData('website') : null;
                $this->website = $this->websiteRepository->getByUuid($website);
            } catch (\Exception $exception) {
                $this->logRepository->addErrorLog('getWebsite', $exception->getMessage());
                return null;
            }
        }

        return $this->website;
    }

    /**
     * @param string|null $filePath
     * @return string
     */
    public function getMediaImageUrl(?string $filePath): string
    {
        return $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . $filePath;
    }

    /**
     * TEMP, todo implement
     * @return float
     */
    public function getMaxRating(): float
    {
        return 5.00;
    }

    /**
     * @return Formatter
     */
    public function formatter(): Formatter
    {
        return $this->formatter;
    }
}
