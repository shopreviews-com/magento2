<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Widget\Review;

use Magento\Widget\Block\BlockInterface;
use Shopreviews\Connect\Block\Widget\Review as ReviewWidget;

class Carousel extends ReviewWidget implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "Shopreviews_Connect::widget/review/carousel.phtml";

    /**
     * @return bool
     */
    public function showReviewSummary(): bool
    {
        return (bool)$this->getData('show_review_summary');
    }

    /**
     * @return bool
     */
    public function showArrows(): bool
    {
        return (bool)$this->getData('show_arrows');
    }

    /**
     * @return bool
     */
    public function isAutoplay(): bool
    {
        return (bool)$this->getData('autoplay');
    }

    /**
     * @return bool
     */
    public function isFullWidth(): bool
    {
        return (bool)$this->getData('full_width');
    }

    /**
     * @return string
     */
    public function getTextLength(): string
    {
        return (string)$this->getData('text_length');
    }

    /**
     * @return string
     */
    public function getSortBy(): string
    {
        return (string)$this->getData('sort_by');
    }

    /**
     * @return string
     */
    public function getSlickConfig(): string
    {
        $slickConfig = [
            'autoplay' => $this->isAutoplay(),
            'arrows' => $this->showArrows(),
            'dots' => (bool)$this->getData('show_dots'),
            'speed' => 800,
            'slidesToShow' => $this->getSlidesToShow(),
            'nextArrow' => $this->getArrowHtml('next'),
            'prevArrow' => $this->getArrowHtml('prev'),
            'responsive' => $this->getResponsiveConfig(),
        ];

        // return $this->toJson($slickConfig); ** This is not working
        return json_encode($slickConfig);
    }

    /**
     * Get the number of slides to show based on widget settings.
     *
     * @return int
     */
    private function getSlidesToShow(): int
    {
        if ($this->isFullWidth()) {
            return 6;
        }
        if (!$this->showReviewSummary()) {
            return 4;
        }
        return 3;
    }

    /**
     * Get responsive configuration based on widget settings.
     *
     * @return array
     */
    private function getResponsiveConfig(): array
    {
        if ($this->isFullWidth()) {
            return $this->buildResponsiveConfig([
                [1599, 5],
                [1439, 4],
                [1279, 3],
                [1023, 2],
                [639, 1],
            ]);
        }

        if (!$this->showReviewSummary()) {
            return $this->buildResponsiveConfig([
                [1279, 3],
                [1023, 2],
                [639, 1],
            ]);
        }

        return $this->buildResponsiveConfig([
            [1279, 2],
            [1023, 1],
            [767, 2],
            [639, 1],
        ]);
    }

    /**
     * Build responsive configuration.
     *
     * @param array $breakpoints Array of breakpoint and slides-to-show pairs.
     * @return array
     */
    private function buildResponsiveConfig(array $breakpoints): array
    {
        return array_map(
            fn ($breakpoint) => (object) [
                'breakpoint' => $breakpoint[0],
                'settings' => (object) ['slidesToShow' => $breakpoint[1]],
            ],
            $breakpoints
        );
    }

    /**
     * Get HTML for navigation arrows.
     *
     * @param string $direction "next" or "prev".
     * @return string
     */
    private function getArrowHtml(string $direction): string
    {
        $arrowPaths = [
            'next' => 'm8.25 4.5 7.5 7.5-7.5 7.5',
            'prev' => 'M15.75 19.5 8.25 12l7.5-7.5',
        ];
        $class = $direction === 'next' ? 'carousel-next' : 'carousel-prev';
        return sprintf(
            '<button type="button" class="%s">' .
            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" ' .
            'stroke="currentColor">' .
            '<path stroke-linecap="round" stroke-linejoin="round" d="%s" />' .
            '</svg>' .
            '</button>',
            $class,
            $arrowPaths[$direction]
        );
    }

    /**
     * @return string
     */
    public function getSectionClass(): string
    {
        return trim(
            ($this->showReviewSummary() ? '' : 'no-summary') . ' ' .
            ($this->isFullWidth() ? 'full-width' : '')
        );
    }
}
