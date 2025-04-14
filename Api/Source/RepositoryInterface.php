<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Source;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shopreviews\Connect\Api\Source\DataInterface as SourceData;
use Shopreviews\Connect\Model\Source\Collection as SourceCollection;

/**
 * Source repository interface
 * @api
 */
interface RepositoryInterface
{

    /**
     * Creates a new source object.
     *
     * @return SourceData
     */
    public function create(): SourceData;

    /**
     * Retrieves a source by entity ID.
     *
     * @param int $entityId
     * @return SourceData
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function get(int $entityId): SourceData;

    /**
     * Retrieves a source by UUID.
     *
     * @param string $uuid
     * @return SourceData
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getByUuid(string $uuid): SourceData;

    /**
     * Retrieves the source collection filtered by website UUID or all sources if no filter is applied.
     *
     * @param string|null $websiteUuid A website UUID to filter by, or null to fetch all sources.
     * @return SourceCollection
     */
    public function getByWebsite(?string $websiteUuid): SourceCollection;

    /**
     * Deletes the specified source.
     *
     * @param SourceData $source
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(SourceData $source): bool;

    /**
     * Deletes a source by entity ID.
     *
     * @param int $entityId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $entityId): bool;

    /**
     * Deletes a source by UUID.
     *
     * @param string $uuid
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteByUuid(string $uuid): bool;

    /**
     * Saves the specified source.
     *
     * @param SourceData $source
     * @return SourceData
     * @throws LocalizedException
     */
    public function save(SourceData $source): SourceData;
}
