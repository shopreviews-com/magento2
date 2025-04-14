<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Platform;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Shopreviews\Connect\Model\Platform\Data as ShopreviewsPlatformData;
use Shopreviews\Connect\Model\Platform\ResourceModel as ShopreviewsPlatformResource;

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
            ShopreviewsPlatformData::class,
            ShopreviewsPlatformResource::class
        );
    }
}
