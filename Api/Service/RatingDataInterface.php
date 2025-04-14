<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Api\Service;

/**
 * Rating information service
 * @api
 */
interface RatingDataInterface
{
    /**
     * @return array
     *    [
     *      '@id'               => (string) Reviews page link
     *      'aggregateRating'   => [
     *          'bestRating'    => (string) Best rating value
     *          'worstRating'   => (string) Worst rating value
     *          'ratingValue'   => (string) Average rating value
     *          'reviewCount'   => (string) Total reviews amount
     *      ]
     *    ]
     */
    public function getRatingInfo(): array;
}
