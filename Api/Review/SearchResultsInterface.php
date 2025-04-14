<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Review;

use Magento\Framework\Api\SearchResultsInterface as FrameworkSearchResultsInterface;
use Shopreviews\Connect\Api\Review\DataInterface as ReviewData;

/**
 * Interface for shopreviews review item search results.
 * @api
 */
interface SearchResultsInterface extends FrameworkSearchResultsInterface
{

    /**
     * Gets review items
     *
     * @return ReviewData[]
     */
    public function getItems() : array;

    /**
     * Sets review items
     *
     * @param ReviewData[] $items
     *
     * @return $this
     */
    public function setItems(array $items) : self;
}
