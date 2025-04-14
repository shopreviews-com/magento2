<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Shopreviews\Connect\Model\Source\CollectionFactory as SourceCollectionFactory;
use Shopreviews\Connect\Api\Source\DataInterface as SourceData;

/**
 * Source of option values in a form of value-label pairs
 */
class Sources implements OptionSourceInterface
{

    public ?array $options = null;
    private SourceCollectionFactory $sourceCollectionFactory;

    public function __construct(
        SourceCollectionFactory $sourceCollectionFactory
    ) {
        $this->sourceCollectionFactory = $sourceCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        if (!$this->options) {
            $websiteCollection = $this->sourceCollectionFactory->create();
            $this->options = [];
            foreach ($websiteCollection->getItems() as $item) {
                $this->options[] = [
                    'value' => $item[SourceData::SOURCE_UUID],
                    'label' => __($item[SourceData::NAME])
                ];
            }
        }

        return $this->options;
    }
}
