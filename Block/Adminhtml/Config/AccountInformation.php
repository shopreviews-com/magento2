<?php
/**
 * Copyright © Shopreviews. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Block\Adminhtml\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigProvider;
use Shopreviews\Connect\Model\Website\ResourceModel as WebsiteResource;
use Shopreviews\Connect\Model\Review\ResourceModel as ReviewResource;
use Shopreviews\Connect\Model\Source\ResourceModel as SourceResource;

/**
 * Account Information block for Admin Configuration
 */
class AccountInformation extends Field
{

    protected $_template = 'Shopreviews_Connect::config/account_information.phtml';
    private ConfigProvider $configProvider;
    private ResourceConnection $resourceConnection;

    public function __construct(
        Context $context,
        ConfigProvider $configProvider,
        ResourceConnection $resourceConnection,
        array $data = []
    ) {
        $this->configProvider = $configProvider;
        $this->resourceConnection = $resourceConnection;
        parent::__construct($context, $data);
    }

    /**
     * Render block HTML
     *
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element): string
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        $html = parent::render($element);
        $customHtml = $this->toHtml();
        return str_replace('<div class="control-value"></div>', $customHtml, $html);
    }

    /**
     * Check if account is active
     *
     * @return bool
     */
    public function isAccountActive(): bool
    {
        return !empty($this->configProvider->getAppName());
    }

    /**
     * @return string
     */
    public function getDisconnectUrl(): string
    {
        return $this->getUrl('shopreviews_com/oAuth/disconnect');
    }


    /**
     * @return string
     */
    public function getConnectUrl(): string
    {
        return $this->getUrl('shopreviews_com/oAuth/connect');
    }

    /**
     * Get account information data
     *
     * @return array
     */
    public function getAccountInformation(): array
    {
        return [
            [
                'label' => __('Account'),
                'value' => $this->configProvider->getAppName() ?? null,
                'actionId' => null,
                'actionUrl' => null,
                'actionTarget' => null,
            ],
            [
                'label' => __('Last Sync'),
                'value' => $this->configProvider->getLastSynced() ?? __('Never'),
                'actionId' => 'shopreviews-sync-reviews',
                'actionUrl' => $this->getUrl('shopreviews_com/review/sync'),
                'actionTarget' => '_self'
            ],
            [
                'label' => __('Websites'),
                'value' => $this->getEntityCount(WebsiteResource::ENTITY_TABLE) . __(' Website(s)'),
                'actionId' => 'shopreviews-show-websites',
                'actionUrl' => $this->getUrl('shopreviews_com/oAuth/modal/type/websites'),
                'actionTarget' => 'modal'
            ],
            [
                'label' => __('Review Sources'),
                'value' => $this->getEntityCount(SourceResource::ENTITY_TABLE) . __(' Source(s)'),
                'actionId' => 'shopreviews-show-sources',
                'actionUrl' => $this->getUrl('shopreviews_com/oAuth/modal/type/sources'),
                'actionTarget' => 'modal'
            ],
            [
                'label' => __('Reviews'),
                'value' => $this->getEntityCount(ReviewResource::ENTITY_TABLE) . __(' Review(s)'),
                'actionId' => null,
            ],
        ];
    }

        /**
     * Get account information data
     *
     * @return array
     */
    public function getModalInforamtion(): array
    {
        return [
            [
                'id' => 'shopreviews-modal-connect',
                'title' => __('Connect'),
            ],
            [
                'id' => 'shopreviews-modal-account',
                'title' => __('Account'),
            ],
            [
                'id' => 'shopreviews-modal-sources',
                'title' => __('Sources'),
            ],
        ];
    }

    /**
     * Get the count of entities in the specified table
     *
     * @param string $tableName
     * @return int
     */
    private function getEntityCount(string $tableName): int
    {
        $connection = $this->resourceConnection->getConnection();
        $fullTableName = $this->resourceConnection->getTableName($tableName);

        if (!$connection->isTableExists($fullTableName)) {
            return 0;
        }

        $select = $connection->select()
            ->from($fullTableName, ['total' => new \Zend_Db_Expr('COUNT(*)')]);

        return (int)$connection->fetchOne($select);
    }
}
