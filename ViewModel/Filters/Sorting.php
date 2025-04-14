<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\ViewModel\Filters;

class Sorting
{
    public function getFilter(array $selectedSorting): array
    {
        return [
            [
                'value' => 'date_asc',
                'selected' => in_array('date_asc', $selectedSorting)
            ],
            [
                'value' => 'date_desc',
                'selected' => !in_array('date_asc', $selectedSorting)
            ],
        ];
    }
}
