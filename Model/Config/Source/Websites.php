<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Shopreviews\Connect\Model\Website\CollectionFactory as WebsiteCollectionFactory;
use Shopreviews\Connect\Api\Website\DataInterface as WebsiteData;

/**
 * Source of option values in a form of value-label pairs
 */
class Websites implements OptionSourceInterface
{

    public ?array $options = null;
    private WebsiteCollectionFactory $websiteCollectionFactory;

    public function __construct(
        WebsiteCollectionFactory $websiteCollectionFactory
    ) {
        $this->websiteCollectionFactory = $websiteCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray(): ?array
    {
        if (!$this->options) {
            $websiteCollection = $this->websiteCollectionFactory->create();
            foreach ($websiteCollection->getItems() as $item) {
                $this->options[] = [
                    'value' => $item[WebsiteData::WEBSITE_UUID],
                    'label' => __($item[WebsiteData::NAME])
                ];
            }
        }

        return $this->options;
    }
}
