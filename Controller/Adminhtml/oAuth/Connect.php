<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\oAuth;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Url;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\LocalizedException;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigProvider;
use Magento\Backend\Model\Auth\Session as AdminSession;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Math\Random as MathRandom;

/**
 * Controller to handle OAuth connection requests.
 */
class Connect extends Action
{
    /**
     * Endpoint to request reference key for installation
     */
    private const ENDPOINT = 'https://app.shopreviews.com/sp/oauth';

    private ?string $token = null;
    private ConfigProvider $configProvider;
    private JsonFactory $resultJsonFactory;
    private AdminSession $adminSession;
    private StoreManagerInterface $storeManager;
    private MathRandom $mathRandom;
    private Url $backendUrlManager;

    public function __construct(
        Action\Context $context,
        JsonFactory $resultJsonFactory,
        ConfigProvider $configProvider,
        AdminSession $adminSession,
        StoreManagerInterface $storeManager,
        MathRandom $mathRandom,
        Url $backendUrlManager
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->configProvider = $configProvider;
        $this->adminSession = $adminSession;
        $this->storeManager = $storeManager;
        $this->backendUrlManager = $backendUrlManager;
        $this->mathRandom = $mathRandom;
    }

    /**
     * Execute the action to generate an OAuth redirect URL.
     *
     * @return Json
     * @throws LocalizedException
     */
    public function execute(): Json
    {
        return $this->resultJsonFactory->create()->setData([
            'url' => $this->generateRedirectUrl(),
            'process_url' => $this->getProcessUrl()
        ]);
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    private function getToken(): string
    {
        if ($this->token === null) {
            $this->token = $this->mathRandom->getRandomString(25);
        }

        return $this->token;
    }

    /**
     * @return string
     */
    private function getProcessUrl(): string
    {
        return $this->backendUrlManager->getUrl(
            'shopreviews_com/oAuth/process/',
            ['token' => $this->getToken()]
        );
    }

    /**
     * @return string
     */
    private function generateRedirectUrl(): string
    {
        $adminUser = $this->adminSession->getUser();

        $params = http_build_query([
            'token' => $this->getToken(),
            'client_id' => $this->configProvider->getCredentials()['client_id'] ?? '',
            'platform' => 'Magento2',
            'version' => $this->configProvider->getExtensionVersion(),
            'prefill_firstname' => $adminUser->getFirstName(),
            'prefill_lastname' => $adminUser->getLastName(),
            'prefill_company' => $this->storeManager->getStore()->getName(),
        ]);

        return self::ENDPOINT . '?' . $params;
    }
}
