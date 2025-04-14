<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Shopreviews\Connect\Api\Review\DataInterface as ShopreviewsReviewData;
use Shopreviews\Connect\Api\Review\RepositoryInterface as ReviewRepository;

/**
 * Source of option values in a form of value-label pairs
 */
class Ratings implements OptionSourceInterface
{

    public ?array $options = null;
    private ReviewRepository $reviewRepository;

    public function __construct(
        ReviewRepository $reviewRepository
    ) {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        if ($this->options !== null) {
            $items = $this->reviewRepository->getRatingsRange();
            $this->options = [];
            foreach ($items as $item) {
                $this->options[] = [
                    'value' => $item[ShopreviewsReviewData::RATING],
                    'label' => __($item[ShopreviewsReviewData::RATING])
                ];
            }
        }

        return $this->options;
    }
}
