<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Widget\Review;

use Magento\Widget\Block\BlockInterface;
use Shopreviews\Connect\Block\Widget\Review as ReviewWidget;

class Textual extends ReviewWidget implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "Shopreviews_Connect::widget/review/textual.phtml";

    /**
     * @return bool
     */
    public function showStars(): bool
    {
        return (bool)$this->getData('show_stars');
    }

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
}
