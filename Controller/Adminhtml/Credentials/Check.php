<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\Credentials;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Shopreviews\Connect\Service\Api\Adapter;

class Check extends Action
{

    public const ADMIN_RESOURCE = 'Shopreviews_Connect::config';

    private JsonFactory $resultJsonFactory;
    private Adapter $adapter;

    public function __construct(
        Action\Context $context,
        JsonFactory $resultJsonFactory,
        Adapter $adapter
    ) {
        $this->messageManager = $context->getMessageManager();
        $this->adapter = $adapter;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute(): Json
    {
        try {
            $result = $this->adapter->execute(Adapter::API_SOURCES, ['skip_status_check' => true]);
            $msg = $result['success'] ? 'Success!' : ($result['error'] ?? 'Unknown Error');
        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
        }

        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData(['result' => $msg]);
    }
}
