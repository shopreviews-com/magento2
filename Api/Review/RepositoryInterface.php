<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Review;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shopreviews\Connect\Api\Review\DataInterface as ReviewData;
use Shopreviews\Connect\Model\Review\Collection as ReviewCollection;

/**
 * Review repository interface
 * @api
 */
interface RepositoryInterface
{
    /**
     * Creates a new review object.
     *
     * @return ReviewData
     */
    public function create(): ReviewData;

    /**
     * Retrieves a review by entity ID.
     *
     * @param int $entityId
     * @return ReviewData
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function get(int $entityId): ReviewData;

    /**
     * Retrieves a review by UUID.
     *
     * @param string $uuid
     * @return ReviewData
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getByUuid(string $uuid): ReviewData;

    /**
     * Deletes the specified review entity.
     *
     * @param ReviewData $review The review entity to delete.
     * @return bool True on success.
     * @throws LocalizedException
     */
    public function delete(ReviewData $review): bool;

    /**
     * Deletes a review entity by its ID.
     *
     * @param int $entityId
     * @return bool True on success.
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $entityId): bool;

    /**
     * Deletes a review entity by its UUID.
     *
     * @param string $uuid
     * @return bool True on success.
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteByUuid(string $uuid): bool;

    /**
     * Saves the specified review entity.
     *
     * @param ReviewData $review The review entity to save.
     * @return ReviewData
     * @throws LocalizedException
     */
    public function save(ReviewData $review): ReviewData;

    /**
     * Retrieves a collection of reviews filtered by source UUIDs.
     *
     * @param array|null $sourceUuids An array of source UUIDs to filter by, or null for no filtering.
     * @param int|null $pageSize
     * @param int|null $page
     * @return ReviewCollection
     */
    public function getBySources(?array $sourceUuids, ?int $pageSize = 10, ?int $page = 1): ReviewCollection;

    /**
     * Retrieve the top reviews for each source UUID.
     *
     * This method fetches the last `$limit` reviews for each `sourceUuid` in the provided array.
     * It ensures that the returned collection contains reviews grouped by source and ordered by
     * the most recent review date.
     *
     * @param array $sourceUuids List of source UUIDs to filter reviews by.
     * @param int|null $limit The maximum number of reviews to fetch per source UUID.
     * @return ReviewCollection The collection containing the top reviews for each source UUID.
     */
    public function getTopReviewsBySources(array $sourceUuids, ?int $limit = 10): ReviewCollection;

    /**
     * Retrieve the range of years based on review dates.
     *
     * @return array The collection of items grouped by review year.
     */
    public function getYearsRange(): array;

    /**
     * Retrieve the range of ratings based on review rating.
     *
     * @return array The collection of items grouped by review rating.
     */
    public function getRatingsRange(): array;
}
