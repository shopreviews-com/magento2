<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Website\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Zend_Db_Expr;

/**
 * Class collection for reviews grid
 */
class Collection extends SearchResult
{

    /**
     * @return SearchResult
     */
    protected function _initSelect(): SearchResult
    {
        parent::_initSelect();
       // $this->getSelect()->joinLeft(
       //     ['source' => $this->getTable('shopreviews_source')],
       //     'main_table.website_uuid = source.website_uuid',
       //     [
        //        'qty_sources' => new Zend_Db_Expr('count(source.source_uuid)'),
         //       'qty_reviews' => new Zend_Db_Expr('sum(source.review_count)'),
          //  ]
        //)->group('main_table.website_uuid');
        return $this;
    }
}
