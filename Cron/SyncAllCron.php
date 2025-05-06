<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Cron;

use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigProvider;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;
use Shopreviews\Connect\Api\Request\RepositoryInterface as RequestRepository;

class SyncAllCron
{
    private ConfigProvider $configProvider;
    private LogRepository $logger;
    private RequestRepository $requestRepository;

    public function __construct(
        ConfigProvider $configProvider,
        RequestRepository $requestRepository,
        LogRepository $logger
    ) {
        $this->configProvider = $configProvider;
        $this->requestRepository = $requestRepository;
        $this->logger = $logger;
    }

    public function execute(): void
    {
        if (!$this->configProvider->isCronEnabled()) {
            return;
        }

        try {
            $this->requestRepository->syncAll();
        } catch (\Exception $e) {
            $this->logger->addErrorLog('SyncAllCron', $e->getMessage());
        }
    }
}
