<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Source of option values in a form of value-label pairs
 */
class BadgeLocation implements OptionSourceInterface
{

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 'manual', 'label' => __('Manual')],
            ['value' => 'top_right', 'label' => __('Top right')],
            ['value' => 'top_left', 'label' => __('Top left')],
            ['value' => 'bottom_right', 'label' => __('Bottom right')],
            ['value' => 'bottom_left', 'label' => __('Bottom left')],
            ['value' => 'sticky_on_right', 'label' => __('Sticky on right')],
            ['value' => 'sticky_on_left', 'label' => __('Sticky on left')]
        ];
    }
}
