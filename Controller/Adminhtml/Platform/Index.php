<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\Platform;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

    public const ADMIN_RESOURCE = 'Shopreview_Connect::review_listing';

    protected PageFactory $resultPageFactory;

    /**
     * Constructor
     *
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        return $this->resultPageFactory->create();
    }
}
