<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\oAuth;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\InputException;
use Shopreviews\Connect\Api\Request\RepositoryInterface as RequestRepository;
use Shopreviews\Connect\Service\Api\Init as Client;
use Magento\Framework\Serialize\Serializer\Json as SerializerJson;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigProvider;

/**
 * Controller to handle OAuth connection requests.
 */
class Process extends Action
{
    /**
     * Endpoint to request reference key for installation
     */
    private const ENDPOINT = 'https://app.shopreviews.com/api/v1/oauth/code-exchange/';

    private SerializerJson $jsonSerializer;
    private ConfigProvider $configProvider;
    private Client $client;
    private RequestRepository $requestRepository;

    public function __construct(
        Action\Context $context,
        Client $client,
        SerializerJson $jsonSerializer,
        ConfigProvider $configProvider,
        RequestRepository $requestRepository
    ) {
        parent::__construct($context);
        $this->client = $client;
        $this->jsonSerializer = $jsonSerializer;
        $this->configProvider = $configProvider;
        $this->requestRepository =$requestRepository;
    }

    /**
     * Execute the action to generate an OAuth redirect URL.
     *
     */
    public function execute()
    {
        $details = $this->getAccountDetails();

        $this->configProvider->updateCredentials(
            $this->getAccountDetails()
        );

        $this->messageManager->addSuccessMessage(__('Connected to %1', $details['app_name'] ?? '-'));
        $this->requestRepository->syncAll();

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('adminhtml/system_config/edit', ['section' => 'shopreviews_com']);
    }

    /**
     * Generate the redirect URL by making a request to the OAuth endpoint.
     *
     * @return array
     */
    private function getAccountDetails(): array
    {
        try {
            $client = $this->client->configureCurlClient();
            $client->get(self::ENDPOINT . $this->getExchangeCode());

            if ($client->getStatus() === 200) {
                return $this->jsonSerializer->unserialize(json_decode($client->getBody()));
            }

            return [
                'message' => 'Failed to get Account Details. Status code: ' . $client->getStatus(),
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'An error occurred: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * @return string|null
     * @throws InputException
     */
    private function getExchangeCode(): ?string
    {
        $exchangeCode = $this->getRequest()->getParam('token');
        if (empty($exchangeCode)) {
            throw new InputException(__('Required params missing in return'));
        }

        return $exchangeCode;
    }
}
