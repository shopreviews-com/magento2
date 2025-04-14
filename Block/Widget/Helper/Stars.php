<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Widget\Helper;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Stars extends Template implements BlockInterface
{

    /**
     * @return int
     */
    public function getSvgSize(): int
    {
        return $this->hasData('svgSize') ? (int)$this->getData('svgSize') : 20;
    }

    /**
     * @return string
     */
    public function getStarColor(): string
    {
        return $this->hasData('starColor') ? (string)$this->getData('starColor') : '';
    }

    /**
     * @return string
     */
    public function getSvgSizeStyle(): string
    {
        $svgSize = $this->getSvgSize();
        return 'width: ' . $svgSize . 'px; height: ' . $svgSize . 'px; ';
    }

    /**
     * @return string
     */
    public function getStarColorStyle(): string
    {
        $starColor = $this->getStarColor();
        return $starColor ? 'color: ' . $starColor : '';
    }

    /**
     * @return string
     */
    public function getPercent(): string
    {
        return $this->hasData('percent') ? $this->getData('percent') . '%' : '0%';
    }
}
