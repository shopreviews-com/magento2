<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Website;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Shopreviews\Connect\Model\Website\Data as ShopreviewsWebsiteData;
use Shopreviews\Connect\Model\Website\ResourceModel as ShopreviewsWebsiteResource;

/**
 * Shop review collection class
 */
class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            ShopreviewsWebsiteData::class,
            ShopreviewsWebsiteResource::class
        );
    }

    /**
     * @inheritDoc
     */
    protected function _afterLoad(): Collection
    {
        parent::_afterLoad();

        foreach ($this as $item) {
            try {
                $this->_resource->unserializeFields($item);
            } catch (\Exception $exception) {
                $this->_logger->critical($exception);
            }
        }

        return $this;
    }
}
