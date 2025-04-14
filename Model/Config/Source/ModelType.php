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
class ModelType implements OptionSourceInterface
{

    public ?array $options = null;

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        if (!$this->options) {
            $this->options = [
                ['value' => 'popup', 'label' => __('Popup')],
                ['value' => 'slideout', 'label' => __('Slideout')]
            ];
        }

        return $this->options;
    }
}
