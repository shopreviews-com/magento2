<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Adminhtml\Config\Button;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;

/**
 * Version check class
 */
class VersionCheck extends Field
{

    /**
     * @var string
     */
    protected $_template = 'Shopreviews_Connect::config/button/version.phtml';
    private ConfigRepository $configRepository;

    /**
     * VersionCheck constructor.
     * @param Context $context
     * @param ConfigRepository $configRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        ConfigRepository $configRepository,
        array $data = []
    ) {
        $this->configRepository = $configRepository;
        parent::__construct($context, $data);
    }

    /**
     * @inheritDoc
     */
    public function render(AbstractElement $element): string
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * @inheritDoc
     */
    public function _getElementHtml(AbstractElement $element): string
    {
        return $this->_toHtml();
    }

    /**
     * Return saved version
     *
     * @return string
     */
    public function getVersion(): string
    {
        return 'v' . $this->configRepository->getExtensionVersion();
    }
}
