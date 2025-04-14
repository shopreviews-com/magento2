<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Platform;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Shopreviews\Connect\Api\Platform\DataInterface as ShopreviewsPlatformData;
use Shopreviews\Connect\Model\Platform\ResourceModel as ShopreviewsPlatformResource;
use Shopreviews\Connect\Service\Tools\ImageProcessing;

/**
 * Shopreview platform data class
 */
class Data extends AbstractModel implements ExtensibleDataInterface, ShopreviewsPlatformData
{

    private ImageProcessing $imageProcessing;

    public function __construct(
        Context $context,
        Registry $registry,
        ImageProcessing $imageProcessing,
        ?AbstractResource $resource = null,
        ?AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->imageProcessing = $imageProcessing;
    }

    /**
     * @inheritDoc
     */
    public function _construct(): void
    {
        $this->_init(ShopreviewsPlatformResource::class);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformUuid(): string
    {
        return (string)$this->getData(self::PLATFORM_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setPlatformUuid(string $platformUuid): ShopreviewsPlatformData
    {
        return $this->setData(self::PLATFORM_UUID, $platformUuid);
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(?string $name): ShopreviewsPlatformData
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function setLogo(?string $url): ShopreviewsPlatformData
    {
        $image = $this->imageProcessing->setUrl($url)->setType('platform/logo');
        $imageUrl = $this->getLogo() !== $image->getPath()
            ? $image->execute()
            : $this->getLogo();

        return $this->setData(self::LOGO, $imageUrl);
    }

    /**
     * @inheritDoc
     */
    public function getLogo(): ?string
    {
        return $this->getData(self::LOGO);
    }

    /**
     * @inheritDoc
     */
    public function setLogoIcon(?string $url): ShopreviewsPlatformData
    {
        $image = $this->imageProcessing->setUrl($url)->setType('platform/icon');
        $imageUrl = $this->getLogoIcon() !== $image->getPath()
            ? $image->execute()
            : $this->getLogoIcon();

        return $this->setData(self::LOGO_ICON, $imageUrl);
    }

    /**
     * @inheritDoc
     */
    public function getLogoIcon(): ?string
    {
        return $this->getData(self::LOGO_ICON);
    }

    /**
     * @inheritDoc
     */
    public function getIsActive(): bool
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(bool $active): ShopreviewsPlatformData
    {
        return $this->setData(self::IS_ACTIVE, $active);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return (string)$this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(?string $date): ShopreviewsPlatformData
    {
        return $this->setData(self::CREATED_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return (string)$this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(?string $date): ShopreviewsPlatformData
    {
        return $this->setData(self::UPDATED_AT, $date);
    }
}
