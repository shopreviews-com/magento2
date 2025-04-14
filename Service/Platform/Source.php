<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Platform;

use Magento\Framework\Data\OptionSourceInterface;
use Shopreviews\Connect\Model\Platform\Collection as PlatformCollection;
use Shopreviews\Connect\Model\Platform\CollectionFactory as PlatformCollectionFactory;

class Source implements OptionSourceInterface
{

    private PlatformCollectionFactory $platformCollectionFactory;
    private ?array $options = null;

    public function __construct(
        PlatformCollectionFactory $platformCollectionFactory
    ) {
        $this->platformCollectionFactory = $platformCollectionFactory;
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
            $this->options[$item->getPlatformUuid()] = [
                'value' => $item->getPlatformUuid(),
                'label' => __($item->getName())
            ];
        }

        return $this->options ?? [];
    }

    /**
     * @return PlatformCollection
     */
    private function getCollection(): PlatformCollection
    {
        return $this->platformCollectionFactory->create();
    }
}
