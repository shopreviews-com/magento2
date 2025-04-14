<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Tools;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Formatter
{

    public ?string $mediaUrl = null;
    private StoreManagerInterface $storeManager;


    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * Format a given date string into a human-readable format.
     *
     * @param string $date
     * @param string|null $format
     * @return string
     */
    public function date(string $date, ?string $format = 'short'): string
    {
        $raw = strtotime($date);
        $today = strtotime('today');
        $yesterday = strtotime('yesterday');
        $mondayThisWeek = strtotime('monday this week');
        $mondayLastWeek = strtotime('monday last week');
        $now = time();

        if ($raw >= $today) {
            return (string)__('Today');
        } elseif ($raw >= $yesterday) {
            return (string)__('Yesterday');
        } elseif ($raw >= $mondayThisWeek) {
            return (string)__('This week');
        } elseif ($raw >= $mondayLastWeek) {
            return (string)__('Last week');
        }

        $daysAgo = (int)(($now - $raw) / (60 * 60 * 24));
        if ($daysAgo <= 30) {
            return (string)__('%1 days ago', $daysAgo);
        }

        return $this->formatDate($raw, $format);
    }

    /**
     * Format the raw timestamp based on the given format.
     *
     * @param int $timestamp
     * @param string|null $format
     * @return string
     */
    private function formatDate(int $timestamp, ?string $format): string
    {
        switch ($format) {
            case 'medium':
                return date('d F Y', $timestamp);
            case 'short':
                return date('d M Y', $timestamp);
            default:
                return date('d m Y', $timestamp);
        }
    }

    /**
     * @param string|null $fileName
     * @return string
     */
    public function getMediaUrl(?string $fileName): ?string
    {
        if ($this->mediaUrl === null) {
            try {
                $this->mediaUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
            } catch (\Exception $exception) {
                return null;
            }
        }

        return $fileName ? $this->mediaUrl . '/' . $fileName : null;
    }

    /**
     * @param $rating
     * @return string
     */
    public function round($rating): string
    {
        return number_format((float)$rating, 1, '.', '');
    }
}
