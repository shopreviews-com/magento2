<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Website;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shopreviews\Connect\Api\Website\DataInterface as WebsiteData;
use Shopreviews\Connect\Model\Website\Collection as WebsiteCollection;

/**
 * Website repository interface
 * @api
 */
interface RepositoryInterface
{
    /**
     * Create a new website object.
     *
     * @return WebsiteData
     */
    public function create(): WebsiteData;

    /**
     * Retrieve a website by entity ID.
     *
     * @param int $entityId
     * @return WebsiteData
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function get(int $entityId): WebsiteData;

    /**
     * Retrieve a website by UUID.
     *
     * @param string $uuid
     * @return WebsiteData
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getByUuid(string $uuid): WebsiteData;

    /**
     * Delete a specified website entity.
     *
     * @param WebsiteData $website
     * @return bool True on success.
     * @throws LocalizedException
     */
    public function delete(WebsiteData $website): bool;

    /**
     * Delete a website entity by its ID.
     *
     * @param int $entityId
     * @return bool True on success.
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $entityId): bool;

    /**
     * Delete a website entity by its UUID.
     *
     * @param string $uuid
     * @return bool True on success.
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteByUuid(string $uuid): bool;

    /**
     * Save the specified website entity.
     *
     * @param WebsiteData $website
     * @return WebsiteData
     * @throws LocalizedException
     */
    public function save(WebsiteData $website): WebsiteData;

    /**
     * Retrieve all active websites.
     *
     * @return WebsiteCollection
     */
    public function getAllActive(): WebsiteCollection;
}
