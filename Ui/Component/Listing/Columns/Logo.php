<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Logo extends Column
{
    private StoreManagerInterface $storeManager;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            $mediaPath = $this->getMediaPath();
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$fieldName . '_src'] = $item[$fieldName] ? $mediaPath . $item[$fieldName] : null;
                $item[$fieldName . '_alt'] = $item['name'];
                $item[$fieldName . 'class'] = $fieldName;
            }
        }

        return $dataSource;
    }

    /**
     * @return string|null
     */
    private function getMediaPath(): ?string
    {
        try {
            return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        } catch (\Exception $exception) {
            return null;
        }
    }
}
