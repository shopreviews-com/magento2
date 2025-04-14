<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\AuthenticationException;
use Magento\Framework\HTTP\ClientInterface as Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigProvider;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;

class Adapter
{

    public const API_SOURCES = '/sources';
    public const API_WEBSITES = '/websites';
    public const API_PLATFORMS = '/platforms';
    public const API_REVIEWS = '/reviews';

    private Curl $curl;
    private Json $json;
    private ConfigProvider $config;
    private LogRepository $log;
    private DateTime $date;

    /** API URLs pattern */
    public const API_URL = 'https://app.shopreviews.com/api/v1';
    public const AUTHENTICATE_URL = 'https://app.shopreviews.com/authenticate';

    public function __construct(
        Curl $curl,
        Json $json,
        ConfigProvider $config,
        LogRepository $log
    ) {
        $this->curl = $curl;
        $this->json = $json;
        $this->config = $config;
        $this->log = $log;
    }

    /**
     * @param string $entry
     * @param array $requestOptions
     * @return array
     * @throws AuthenticationException
     * @throws LocalizedException
     */
    public function execute(string $entry, array $requestOptions = []): array
    {
        if (!$this->config->isEnabled() && empty($requestOptions['skip_status_check'])) {
            throw new LocalizedException(__('Module not enabled!'));
        }

        if (!isset($requestOptions['company_uuid']) || !isset($requestOptions['access_token'])) {
            $requestOptions['company_uuid'] = $this->config->getCompanyUuid();
            $requestOptions['access_token'] = $this->config->getAccessToken();
        }

        $this->curl->addHeader('Content-Type', 'application/json');
        $this->curl->addHeader('Authorization', 'Bearer ' . $requestOptions['access_token']);
        $this->curl->get($this->formatUrl($entry, $requestOptions));

        $result = $this->json->unserialize(
            $this->curl->getBody()
        );

        $status = $this->curl->getStatus();
        $this->log->addDebugLog($entry . " [$status]", $result);

        // TODO ADD SWITCH OR MATCH
        if ($status == 400) {
            throw new AuthenticationException(
                __(!empty($result['error']) ? $result['error'] : 'Could not connect!')
            );
        }

        if ($status >= 100 && $status < 300) {
            $result['success'] = true;
            $this->config->setLastSynced();
        } else {
            $result['success'] = false;
        }

        return $result;
    }

    /**
     * @param string $entry
     * @param array $requestOptions
     * @return string
     */
    private function formatUrl(string $entry, array $requestOptions): string
    {
        $query = http_build_query(array_filter([
            'limit' => $requestOptions['limit'] ?? null,
            'page' => $requestOptions['page'] ?? null
        ]));

        return $query
            ? self::API_URL . $entry . '?' . $query
            : self::API_URL . $entry;
    }

    /**
     * @param string $type
     * @return string
     */
    public function getConnectionUrl(string $type): string
    {
        return sprintf(
            '%s/%s/%s',
            self::AUTHENTICATE_URL,
            $this->config->getAccessToken(),
            $type
        );
    }
}
