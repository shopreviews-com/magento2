<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Widget\Review;

use Magento\Widget\Block\BlockInterface;
use Shopreviews\Connect\Block\Widget\Review as ReviewWidget;

class Badge extends ReviewWidget implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = 'Shopreviews_Connect::widget/review/badge.phtml';

    /**
     * @return bool
     */
    public function enableModalLink(): bool
    {
        return (bool)$this->getData('enable_modal_link');
    }

    /**
     * @return string
     */
    public function getModalType(): string
    {
        return (string)$this->getData('modal_type');
    }

    /**
     * @return string
     */
    public function getSectionClass(): string
    {
        return implode(
            ' ',
            [
                (string)$this->getData('badge_location'),
                (string)$this->getData('show_score'),
                $this->enableModalLink() ? 'modal-enabled' : ''
            ]
        );
    }
}
