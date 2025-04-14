<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Review;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Shopreviews review resource class
 */
class ResourceModel extends AbstractDb
{
    
    public const ENTITY_TABLE = 'shopreviews_review';
    public const PRIMARY = 'entity_id';

    /**
     * Serializable field: questions
     *
     * @var array
     */
    protected $_serializableFields = ['questions' => [null, []]];

    /**
     * @inheritDoc
     */
    public function _construct(): void
    {
        $this->_init(self::ENTITY_TABLE, self::PRIMARY);
    }

    /**
     * Check is entity exists
     *
     * @param int $entityId
     * @return bool
     */
    public function isExists(int $entityId): bool
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getTable(self::ENTITY_TABLE), self::PRIMARY)
            ->where('entity_id = :entity_id');
        $bind = [':entity_id' => $entityId];
        return (bool)$connection->fetchOne($select, $bind);
    }

    /**
     * Check is entity exists
     *
     * @param string $uuid
     * @return bool
     */
    public function isUuidExists(string $uuid): bool
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getTable(self::ENTITY_TABLE), 'review_uuid')
            ->where('review_uuid = :uuid');
        $bind = [':uuid' => $uuid];
        return (bool)$connection->fetchOne($select, $bind);
    }
}
