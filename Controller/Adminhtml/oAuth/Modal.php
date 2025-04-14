<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\oAuth;

use Magento\Backend\App\Action;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Shopreviews\Connect\Service\Api\Adapter as Client;

/**
 * Controller to handle OAuth connection requests.
 */
class Modal extends Action
{
    /**
     * Endpoint to request reference key for installation
     */
    private const ENDPOINT = 'https://app.shopreviews.com/sp/oauth';

    private JsonFactory $resultJsonFactory;
    private Client $client;
    private RequestInterface $request;

    /**
     * @param Action\Context $context
     * @param JsonFactory $resultJsonFactory
     * @param Client $client
     */
    public function __construct(
        Action\Context $context,
        JsonFactory $resultJsonFactory,
        Client $client
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->client = $client;
        $this->request = $context->getRequest();
    }

    /**
     * Execute the action to generate an OAuth redirect URL.
     *
     * @return Json
     */
    public function execute(): Json
    {
        $type = $this->request->getParam('type');
        $url = (string)$this->client->getConnectionUrl($type);

        // Use the JsonFactory to create the response
        $result = $this->resultJsonFactory->create();
        $result->setData(['url' => $url]);

        return $result;
    }
}
