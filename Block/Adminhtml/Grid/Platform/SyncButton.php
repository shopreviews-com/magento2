<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Adminhtml\Grid\Platform;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Shopreviews\Connect\Block\Adminhtml\Grid\GenericButton;

class SyncButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @inheritDoc
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Sync All')->render(),
            'on_click' => sprintf("location.href = '%s';", $this->getSyncUrl()),
            'class' => 'primary',
            'sort_order' => 20
        ];
    }

    public function getSyncUrl(): string
    {
        return $this->getUrl('*/platform/sync');
    }
}
