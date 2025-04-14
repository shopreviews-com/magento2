<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Review;

use Magento\Framework\Exception\AuthenticationException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;
use Shopreviews\Connect\Api\Review\DataInterface as ReviewData;
use Shopreviews\Connect\Api\Review\RepositoryInterface as ReviewRepository;
use Shopreviews\Connect\Service\Api\Adapter;

class Sync
{
    public int $updated = 0;
    public int $new = 0;
    public int $error = 0;
    private Adapter $adapter;
    private ReviewRepository $reviewRepository;
    private LogRepository $logger;

    public function __construct(
        Adapter $adapter,
        ReviewRepository $reviewRepository,
        LogRepository $logger
    ) {
        $this->adapter = $adapter;
        $this->reviewRepository = $reviewRepository;
        $this->logger = $logger;
    }

    /**
     * @throws LocalizedException
     */
    public function execute(): array
    {
        $reviews = $this->getMappedReviews(['limit' => 100000, 'page' => 0]);

        foreach ($reviews['data'] as $reviewData) {
            if (empty($reviewData['uuid'])) {
                continue;
            }
            try {
                $review = $this->loadSavedReview($reviewData['uuid'])
                    ->setName($reviewData['name'])
                    ->setEmail($reviewData['email'])
                    ->setDescription((string)$reviewData['body'])
                    ->setRating((int)$reviewData['rating'])
                    ->setSourceUuid((string)$reviewData['source_uuid'])
                    ->setPlatformUuid((string)$reviewData['platform_uuid'])
                    ->setCompanyUuid((string)$reviewData['company_uuid'])
                    ->setLocaleCode($reviewData['local_code'] ?? null)
                    ->setReviewDate((string)$reviewData['review_at']);
                $this->reviewRepository->save($review);
            } catch (\Exception $exception) {
                $this->logger->addErrorLog('Review Import', $exception->getMessage());
                $this->error++;
            }
        }

        return [
            'success' => true,
            'new' => $this->new,
            'updated' => $this->updated,
            'error' => $this->error
        ];
    }

    /**
     * @param array|null $requestOptions
     * @return array
     * @throws AuthenticationException
     * @throws LocalizedException
     */
    private function getMappedReviews(?array $requestOptions): array
    {
        return $this->adapter->execute(Adapter::API_REVIEWS, $requestOptions);
    }

    /**
     * @param string $reviewUuid
     * @return ReviewData
     * @throws LocalizedException
     */
    private function loadSavedReview(string $reviewUuid): ReviewData
    {
        try {
            $review = $this->reviewRepository->getByUuid($reviewUuid);
            $this->updated++;
        } catch (NoSuchEntityException $exception) {
            $review = $this->reviewRepository->create()->setReviewUuid($reviewUuid);
            $this->new++;
        }

        return $review;
    }
}
