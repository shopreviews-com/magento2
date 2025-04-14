<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Adminhtml\Design;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Header extends Field
{

    /**
     * @var string
     */
    protected $_template = 'Shopreviews_Connect::config/fieldset/header.phtml';

    /**
     * @param AbstractElement $element
     *
     * @return string
     */
    public function render(AbstractElement $element): string
    {
        $element->addClass('shopreviews');
        return $this->toHtml();
    }
}
