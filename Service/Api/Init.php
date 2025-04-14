<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Api;

use Magento\Framework\HTTP\ClientInterface;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigProvider;

/**
 * Service to initialize and configure HTTP Client with default headers for API communication.
 */
class Init
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $curl;
    private ConfigProvider $configProvider;

    public function __construct(
        ClientInterface $curl,
        ConfigProvider $configProvider
    ) {
        $this->curl = $curl;
        $this->configProvider = $configProvider;
    }

    /**
     * Configures and returns the HTTP client with default headers.
     *
     * @param array $additionalHeaders Additional headers to include in the client.
     * @return ClientInterface Configured HTTP client.
     */
    public function configureCurlClient(array $additionalHeaders = []): ClientInterface
    {
        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-Platform' => 'Magento2',
            'X-Platform-Token' => $this->configProvider->getPlatformToken()
        ];

        foreach (array_merge($defaultHeaders, $additionalHeaders) as $key => $value) {
            $this->curl->addHeader($key, $value);
        }

        return $this->curl;
    }
}
