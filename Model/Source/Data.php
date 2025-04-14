<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Source;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Shopreviews\Connect\Api\Source\DataInterface as ShopreviewsSourceData;
use Shopreviews\Connect\Model\Source\ResourceModel as ShopreviewsSourceResource;
use Shopreviews\Connect\Service\Tools\ImageProcessing;

class Data extends AbstractModel implements ExtensibleDataInterface, ShopreviewsSourceData
{
    private ImageProcessing $imageProcessing;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param ImageProcessing $imageProcessing
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
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
        $this->_init(ShopreviewsSourceResource::class);
    }

    /**
     * @inheritDoc
     */
    public function getSourceUuid(): string
    {
        return (string)$this->getData(self::SOURCE_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setSourceUuid(string $sourceUuid): ShopreviewsSourceData
    {
        return $this->setData(self::SOURCE_UUID, $sourceUuid);
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
    public function setName(?string $name): ShopreviewsSourceData
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getLogoUrl(): ?string
    {
        return $this->getData(self::LOGO_URL);
    }

    /**
     * @inheritDoc
     */
    public function setLogoUrl(?string $url): ShopreviewsSourceData
    {
        $image = $this->imageProcessing->setUrl($url)->setType('company/logo');
        $imageUrl = $this->getLogoUrl() !== $image->getPath()
            ? $image->execute()
            : $this->getLogoUrl();

        return $this->setData(self::LOGO_URL, $imageUrl);
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): ?string
    {
        return $this->getData(self::URL);
    }

    /**
     * @inheritDoc
     */
    public function setUrl(?string $url): ShopreviewsSourceData
    {
        return $this->setData(self::URL, $url);
    }

    /**
     * @inheritDoc
     */
    public function getReviewLink(): ?string
    {
        return $this->getData(self::REVIEW_LINK);
    }

    /**
     * @inheritDoc
     */
    public function setReviewLink(?string $url): ShopreviewsSourceData
    {
        return $this->setData(self::REVIEW_LINK, $url);
    }

    /**
     * @inheritDoc
     */
    public function getCompanyUuid(): ?string
    {
        return $this->getData(self::COMPANY_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setCompanyUuid(?string $uuid): ShopreviewsSourceData
    {
        return $this->setData(self::COMPANY_UUID, $uuid);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformUuid(): ?string
    {
        return $this->getData(self::PLATFORM_UUID);
    }

    /**
     * @inheritDoc
     */
    public function setPlatformUuid(?string $uuid): ShopreviewsSourceData
    {
        return $this->setData(self::PLATFORM_UUID, $uuid);
    }

    /**
     * @inheritDoc
     */
    public function getWebsiteUuids(): ?array
    {
        return $this->getData(self::WEBSITE_UUIDS);
    }

    /**
     * @inheritDoc
     */
    public function setWebsiteUuids(?array $uuids): ShopreviewsSourceData
    {
        return $this->setData(self::WEBSITE_UUIDS, $uuids);
    }

    /**
     * @inheritDoc
     */
    public function getReviewCount(): int
    {
        return (int)$this->getData(self::REVIEW_COUNT);
    }

    /**
     * @inheritDoc
     */
    public function setReviewCount(int $count): ShopreviewsSourceData
    {
        return $this->setData(self::REVIEW_COUNT, $count);
    }

    /**
     * @inheritDoc
     */
    public function getAvgRating(): ?float
    {
        return $this->getData(self::AVG_RATING) ? (float)$this->getData(self::AVG_RATING) : null;
    }

    /**
     * @inheritDoc
     */
    public function setAvgRating(?float $rating): ShopreviewsSourceData
    {
        return $this->setData(self::AVG_RATING, $rating);
    }

    /**
     * @inheritDoc
     */
    public function getLastSyncedAt(): ?string
    {
        return $this->getData(self::LAST_SYNCED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setLastSyncedAt(?string $date): ShopreviewsSourceData
    {
        return $this->setData(self::LAST_SYNCED_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function getNextSyncAt(): ?string
    {
        return $this->getData(self::NEXT_SYNC_AT);
    }

    /**
     * @inheritDoc
     */
    public function setNextSyncAt(?string $date): ShopreviewsSourceData
    {
        return $this->setData(self::NEXT_SYNC_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(?string $date): ShopreviewsSourceData
    {
        return $this->setData(self::UPDATED_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(?string $date): ShopreviewsSourceData
    {
        return $this->setData(self::CREATED_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformName(): ?string
    {
        return $this->getData(self::PLATFORM_NAME);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformLogo(): ?string
    {
        return $this->getData(self::PLATFORM_LOGO);
    }

    /**
     * @inheritDoc
     */
    public function getPlatformIcon(): ?string
    {
        return $this->getData(self::PLATFORM_ICON);
    }
}
