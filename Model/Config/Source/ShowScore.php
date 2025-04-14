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
class ShowScore implements OptionSourceInterface
{

    public ?array $options = null;

    public function toOptionArray(): array
    {
        if (!$this->options) {
            $this->options = [
                ['value' => 'always', 'label' => __('Always')],
                ['value' => 'never', 'label' => __('Never')],
                ['value' => 'slide_down', 'label' => __('Slide down (hide on sticky options)')],
                ['value' => 'slide_right', 'label' => __('Slide right (hide on sticky options)')]
            ];
        }

        return $this->options;
    }
}
