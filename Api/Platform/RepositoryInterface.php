<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Platform;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shopreviews\Connect\Api\Platform\DataInterface as PlatformData;

/**
 * Platform repository interface
 * @api
 */
interface RepositoryInterface
{

    /**
     * Creates a new platform object.
     *
     * @return PlatformData
     */
    public function create(): PlatformData;

    /**
     * Retrieves a platform by entity ID.
     *
     * @param int $entityId
     * @return PlatformData
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function get(int $entityId): PlatformData;

    /**
     * Retrieves a platform by UUID.
     *
     * @param string $uuid
     * @return PlatformData
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getByUuid(string $uuid): PlatformData;

    /**
     * Deletes the specified platform.
     *
     * @param PlatformData $platform
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PlatformData $platform): bool;

    /**
     * Deletes a platform by entity ID.
     *
     * @param int $entityId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $entityId): bool;

    /**
     * Deletes a platform by UUID.
     *
     * @param string $uuid
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteByUuid(string $uuid): bool;

    /**
     * Saves the specified platform.
     *
     * @param PlatformData $platform
     * @return PlatformData
     * @throws LocalizedException
     */
    public function save(PlatformData $platform): PlatformData;
}
