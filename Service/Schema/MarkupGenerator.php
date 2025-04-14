<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Schema;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;
use Shopreviews\Connect\Api\Website\DataInterface as WebsiteData;

class MarkupGenerator implements ArgumentInterface
{

    private ConfigRepository $configRepository;
    private UrlInterface $urlBuilder;

    /**
     * @param ConfigRepository $configRepository
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        ConfigRepository $configRepository,
        UrlInterface $urlBuilder
    ) {
        $this->configRepository = $configRepository;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param ?WebsiteData $website
     * @param array|null $reviews
     * @return bool|false|string
     */
    public function generateStructuredData(?WebsiteData $website, ?array $reviews): ?array
    {
        if (!$website) {
            return [];
        }

        $companyData = $this->configRepository->getCompanyData();

        return [
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "@id" => $this->configRepository->getReviewPageUrl(),
            "url" => $this->urlBuilder->getUrl(),
            "name" => $website->getName(),
            "logo" => $website->getLogo(),
            "image" => $website->getLogo(),
            "telephone" => $this->configRepository->getStorePhone(),
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => $companyData['streetAddress'],
                "postalCode" => $companyData['postalCode'],
                "addressLocality" => $companyData['addressLocality'],
                "addressCountry" => $companyData['addressCountry'],
            ],
            "aggregateRating" => [
                "@type" => "AggregateRating",
                "bestRating" => $website->getBestRating(),
                "worstRating" => $website->getWorstRating(),
                "ratingValue" => $website->getAvgRating(),
                "reviewCount" => $website->getReviewCount(),
            ],
            'review' => $reviews ? $this->getReviewsArray($website, $reviews) : []
        ];
    }

    /**
     * @param WebsiteData $website
     * @param array|null $reviews
     * @return array
     */
    private function getReviewsArray(WebsiteData $website, ?array $reviews): array
    {
        $reviewsArray = [];

        foreach ($reviews as $review) {
            $reviewsArray[] = [
                "@type" => "Review",
                "author" => [
                    "@type" => "Person",
                    "name" => $review['name']
                ],
                "dateCreated" => $review['clean_date'],
                "reviewBody" => $review['description'],
                "headline" => '',
                "reviewRating" => [
                    "@type" => "Rating",
                    "bestRating" => $website->getBestRating(),
                    "worstRating" => $website->getWorstRating(),
                    "ratingValue" => $review['total']
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => $review['platform_name'],
                    "sameAs" => $review['source_url']
                ],
                "inLanguage" => $review['locale_code']
            ];
        }

        return $reviewsArray;
    }
}
