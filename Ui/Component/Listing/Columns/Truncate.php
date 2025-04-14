<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Ui\Component\Listing\Columns;

use Magento\Framework\Filter\FilterManager;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Truncate extends Column
{

    /**
     * @var FilterManager
     */
    private $filter;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        FilterManager $filter,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->filter = $filter;
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                $item[$name] = $this->filter->truncate($item[$name], 300);
            }
        }
        return $dataSource;
    }
}
