<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\Backend;

use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Value;
use Magento\Framework\App\Config\ValueFactory;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

class Cron extends Value
{

    private const CRON_PATHS = [
        'crontab/default/jobs/shopreviews_com_sync_all/schedule' => [
            'frequency' => 'groups/automation/fields/cron_frequency/value',
            'custom' => 'groups/automation/fields/custom_frequency/value'
        ]
    ];

    private ValueFactory $configValueFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        ValueFactory $configValueFactory,
        ?AbstractResource $resource = null,
        ?AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->configValueFactory = $configValueFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * @throws LocalizedException
     */
    public function afterSave(): Value
    {
        try {
            foreach (self::CRON_PATHS as $path => $configPath) {
                $value = $this->getData($configPath['frequency']) == 'custom'
                    ? $this->getData($configPath['custom'])
                    : $this->getData($configPath['frequency']);

                $this->configValueFactory->create()
                    ->load($path, 'path')
                    ->setValue($value)
                    ->setPath($path)
                    ->save();
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__('We can\'t save the cron expression.'));
        }

        return parent::afterSave();
    }
}
