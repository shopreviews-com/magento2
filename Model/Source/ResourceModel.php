<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Source;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Shopreviews review resource class
 */
class ResourceModel extends AbstractDb
{

    public const ENTITY_TABLE = 'shopreviews_source';
    public const PRIMARY = 'entity_id';

    /**
     * @inheritDoc
     */
    protected $_serializableFields = ['website_uuids' => [[], []]];

    /**
     * @inheritDoc
     */
    public function _construct(): void
    {
        $this->_init(self::ENTITY_TABLE, self::PRIMARY);
    }
}
