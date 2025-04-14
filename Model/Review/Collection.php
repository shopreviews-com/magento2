<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Review;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Shopreviews\Connect\Model\Review\Data as ShopreviewsReviewData;
use Shopreviews\Connect\Model\Review\ResourceModel as ShopreviewsReviewResource;

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
            ShopreviewsReviewData::class,
            ShopreviewsReviewResource::class
        );

        $this->mapFilters([
            'source_uuid' => 'main_table.source_uuid',
            'platform_uuid' => 'main_table.platform_uuid',
        ]);
    }

    /**
     * Maps filters to their respective table columns.
     *
     * @param array $filters Key-value pair of filter mappings.
     */
    private function mapFilters(array $filters): void
    {
        foreach ($filters as $alias => $column) {
            $this->addFilterToMap($alias, $column);
        }
    }

    /**
     * @inheritDoc
     */
    protected function _renderFiltersBefore(): void
    {
        if ($this->isLoaded()) {
            return;
        }

        $this->joinTables([
            'shopreviews_platform' => [
                'alias' => 'platform',
                'condition' => 'main_table.platform_uuid = platform.platform_uuid',
                'columns' => [
                    'platform_name' => 'name',
                    'platform_logo' => 'logo',
                    'platform_icon' => 'logo_icon',
                ],
            ],
            'shopreviews_source' => [
                'alias' => 'source',
                'condition' => 'main_table.source_uuid = source.source_uuid',
                'columns' => [
                    'source_url' => 'source.url',
                    'source_review_link' => 'source.review_link',
                    'source_review_count' => 'source.review_count',
                    'source_avg_rating' => 'source.avg_rating',
                ],
            ],
        ]);

        parent::_renderFiltersBefore();
    }

    /**
     * Joins tables dynamically to the collection select query.
     *
     * @param array $tables Key-value pair of tables and join conditions.
     */
    private function joinTables(array $tables): void
    {
        foreach ($tables as $tableName => $data) {
            $this->getSelect()->join(
                [$data['alias'] => $this->getTable($tableName)],
                $data['condition'],
                $data['columns']
            );
        }
    }
}