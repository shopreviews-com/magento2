<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\oAuth;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Controller\Result\Redirect;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigProvider;
use Shopreviews\Connect\Model\Website\ResourceModel as WebsiteResource;
use Shopreviews\Connect\Model\Review\ResourceModel as ReviewResource;
use Shopreviews\Connect\Model\Source\ResourceModel as SourceResource;
use Shopreviews\Connect\Model\Platform\ResourceModel as PlatformResource;

/**
 * Controller to handle OAuth disconnection requests.
 */
class Disconnect extends Action
{
    private ConfigProvider $configProvider;
    private ResourceConnection $resourceConnection;

    public function __construct(
        Action\Context $context,
        ConfigProvider $configProvider,
        ResourceConnection $resourceConnection
    ) {
        parent::__construct($context);
        $this->configProvider = $configProvider;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Execute the action to disconnect the account and flush tables.
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        try {
            $this->configProvider->resetCredentials();
            $tablesToFlush = [
                WebsiteResource::ENTITY_TABLE,
                PlatformResource::ENTITY_TABLE,
                SourceResource::ENTITY_TABLE,
                ReviewResource::ENTITY_TABLE,
            ];

            foreach ($tablesToFlush as $table) {
                $this->flushTable($table);
            }

            $this->messageManager->addSuccessMessage(__('Account disconnected successfully, and data flushed.'));

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred: %1', $e->getMessage()));
        }

        return $this->resultRedirectFactory->create()->setUrl($this->_redirect->getRefererUrl());
    }

    /**
     * Flush the specified table by truncating its contents.
     *
     * @param string $tableName
     * @return void
     */
    private function flushTable(string $tableName): void
    {
        $connection = $this->resourceConnection->getConnection();
        $fullTableName = $this->resourceConnection->getTableName($tableName);

        if ($connection->isTableExists($fullTableName)) {
            $connection->query('SET FOREIGN_KEY_CHECKS = 0');
            $connection->truncateTable($fullTableName);
            $connection->query('SET FOREIGN_KEY_CHECKS = 1');
        }
    }
}
