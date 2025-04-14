<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Source;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Shopreviews\Connect\Model\Source\Data as ShopreviewsSourceData;
use Shopreviews\Connect\Model\Source\ResourceModel as ShopreviewsSourceResource;

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
    protected function _construct(): void
    {
        $this->_init(
            ShopreviewsSourceData::class,
            ShopreviewsSourceResource::class
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

    /**
     * @inheritDoc
     */
    protected function _renderFiltersBefore()
    {
        if ($this->isLoaded()) {
            return;
        }

        $this->getSelect()->join(
            ['platform' => $this->getTable('shopreviews_platform')],
            'main_table.platform_uuid = platform.platform_uuid',
            [
                'platform_name' => 'name',
                'platform_logo' => 'logo',
                'platform_icon' => 'logo_icon',
            ]
        );

        parent::_renderFiltersBefore();
    }
}
