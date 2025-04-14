<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Platform;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Exception\FileSystemException;

/**
 * Platforms object interface
 * @api
 */
interface DataInterface extends ExtensibleDataInterface
{

    /**
     * Constants for keys of data array.
     */
    public const PLATFORM_UUID = 'platform_uuid';
    public const NAME = 'name';
    public const LOGO = 'logo';
    public const LOGO_ICON = 'logo_icon';
    public const IS_ACTIVE = 'is_active';
    public const UPDATED_AT = 'platform_created_at';
    public const CREATED_AT = 'platform_updated_at';

    /**
     * @return string
     */
    public function getPlatformUuid(): string;

    /**
     * @param string $platformUuid
     * @return $this
     */
    public function setPlatformUuid(string $platformUuid): self;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self;

    /**
     * @return string|null
     */
    public function getLogo(): ?string;

    /**
     * @param string|null $url
     * @return $this
     * @throws FileSystemException
     */
    public function setLogo(?string $url): self;

    /**
     * @return string|null
     */
    public function getLogoIcon(): ?string;

    /**
     * @param string|null $url
     * @return $this
     * @throws FileSystemException
     */
    public function setLogoIcon(?string $url): self;

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @param bool $active
     * @return $this
     */
    public function setIsActive(bool $active): self;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * @param string|null $date
     * @return $this
     */
    public function setUpdatedAt(?string $date): self;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param string|null $date
     * @return $this
     */
    public function setCreatedAt(?string $date): self;
}
