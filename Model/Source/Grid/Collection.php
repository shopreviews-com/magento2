<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Source\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Class collection for reviews grid
 */
class Collection extends SearchResult
{

    /**
     * @inheritDoc
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->joinLeft(
            ['shopreviews_platform' => $this->getTable('shopreviews_platform')],
            'main_table.platform_uuid = shopreviews_platform.platform_uuid',
            [
                'platform_name' => 'shopreviews_platform.name',
                'platform_logo_icon' => 'shopreviews_platform.logo_icon',
            ]
        );
        return $this;
    }
    
    /**
     * @return $this
     */
    protected function _afterLoad(): Collection
    {
        parent::_afterLoad();

        foreach ($this as $item) {
            $serializedData = $item->getData('website_uuids');
            if ($serializedData) {
                $item->setData('website_uuids', json_decode($serializedData));
            }
        }

        return $this;
    }
}
