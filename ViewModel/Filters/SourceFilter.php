<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\ViewModel\Filters;

use Shopreviews\Connect\Model\Source\Collection as SourceCollection;
use Shopreviews\Connect\Api\Source\DataInterface;
use Shopreviews\Connect\Service\Tools\Formatter;

class SourceFilter
{

    private Formatter $formatter;

    public function __construct(
        Formatter $formatter
    ) {
        $this->formatter = $formatter;
    }

    /**
     * Retrieve available sources with their selection status.
     *
     * @param array $selectedSources List of selected sources.
     * @param SourceCollection $sources
     * @return array
     */
    public function getFilter(array $selectedSources, SourceCollection $sources): array
    {
        $result = [];
        /** @var DataInterface $source */
        foreach ($sources as $source) {
            $result[] = [
                'value' => $source->getSourceUuid(),
                'label' => $source->getPlatformName(),
                'icon' => $this->formatter->getMediaUrl($source->getPlatformIcon()),
                'selected' => in_array('all', $selectedSources) || in_array($source->getSourceUuid(), $selectedSources),
                'count' => $source->getReviewCount()
            ];
        }

        return $result;
    }

    /**
     * Resolve the sources filter based on selected ratings.
     *
     * @param array $selectedSources List of selected sources.
     * @return array|bool The selected sources or false if no valid selection exists.
     */
    public function resolveFilter(array $selectedSources)
    {
        return empty(current($selectedSources)) || in_array('all', $selectedSources)
            ? false
            : $selectedSources;
    }
}
