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
class TextLength implements OptionSourceInterface
{

    public ?array $options = null;

    public function toOptionArray(): array
    {
        if (!$this->options) {
            $this->options = [
                ['value' => 'small', 'label' => __('Small')],
                ['value' => 'medium', 'label' => __('Medium')],
                ['value' => 'large', 'label' => __('Large')]
            ];
        }

        return $this->options;
    }
}
