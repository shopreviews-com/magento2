<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Website;

use Magento\Framework\Data\OptionSourceInterface;
use Shopreviews\Connect\Model\Website\Collection as WebsiteCollection;
use Shopreviews\Connect\Model\Website\CollectionFactory as WebsiteCollectionFactory;

class Source implements OptionSourceInterface
{
    private WebsiteCollectionFactory $websiteCollectionFactory;
    private ?array $options = null;

    public function __construct(
        WebsiteCollectionFactory $websiteCollectionFactory
    ) {
        $this->websiteCollectionFactory = $websiteCollectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        if ($this->options !== null) {
            return $this->options;
        }

        foreach ($this->getCollection() as $item) {
            $this->options[$item->getWebsiteUuid()] = [
                'value' => $item->getWebsiteUuid(),
                'label' => __($item->getName())
            ];
        }

        return $this->options ?? [];
    }

    /**
     * @return WebsiteCollection
     */
    private function getCollection(): WebsiteCollection
    {
        return $this->websiteCollectionFactory->create();
    }
}
