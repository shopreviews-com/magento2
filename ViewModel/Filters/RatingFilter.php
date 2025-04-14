<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\ViewModel\Filters;

use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;
use Shopreviews\Connect\Model\Config\Source\AllowedRatings;

class RatingFilter
{

    private ConfigRepository $configRepository;
    private array $ratingsArr;

    public function __construct(
        ConfigRepository $configRepository,
        AllowedRatings $allowedRatings
    ) {
        $this->configRepository = $configRepository;
        $this->ratingsArr = array_reverse($allowedRatings->toOptionArray());
    }

    /**
     * Retrieve available ratings with their selection status.
     *
     * @param array $selectedRatings List of selected ratings.
     * @return array
     */
    public function getFilter(array $selectedRatings): array
    {
        $result = [];
        $allowedRatings = array_reverse(explode(',', $this->configRepository->getDisplayRatings()));

        foreach ($this->ratingsArr as $rating) {
            if (empty(current($allowedRatings)) || in_array($rating['value'], $allowedRatings)) {
                $result[] = [
                    'value' => $rating['value'],
                    'selected' => in_array('all', $selectedRatings) || in_array($rating['value'], $selectedRatings)
                ];
            }
        }

        return $result;
    }

    /**
     * Resolve the ratings filter based on selected ratings.
     *
     * @param array $selectedRatings List of selected ratings.
     * @return array|bool The selected ratings or false if no valid selection exists.
     */
    public function resolveFilter(array $selectedRatings)
    {
        return empty(current($selectedRatings)) || in_array('all', $selectedRatings)
            ? false
            : $selectedRatings;
    }
}
