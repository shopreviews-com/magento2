<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Adminhtml\Grid;

use Magento\Backend\Block\Widget\Context;

class GenericButton
{

    protected Context $context;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string|null $route
     * @param array|null $params
     *
     * @return string
     */
    public function getUrl(?string $route = '', ?array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
