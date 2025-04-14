<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Test;

use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;

/**
 * Magento version test class
 */
class MagentoVersion
{

    public const TYPE = 'magento_version';
    public const TEST = 'Check if current Magento version is supported for this module version';
    public const VISIBLE = true;
    public const SUCCESS_MSG = 'Magento version match';
    public const FAILED_MSG = 'Minumum required Magento 2 version is %s, curent version is %s!';
    public const SUPPORT_LINK = 'https://www.magmodules.eu/help/magento2/minimum-magento-version.html';
    public const EXPECTED = '2.3';

    private ConfigRepository $configRepository;

    public function __construct(
        ConfigRepository $configRepository
    ) {
        $this->configRepository = $configRepository;
    }

    /**
     * @return array
     */
    public function execute(): array
    {
        $result = [
            'type' => self::TYPE,
            'test' => self::TEST,
            'visible' => self::VISIBLE,

        ];

        $magentoVersion = $this->configRepository->getMagentoVersion();
        if (version_compare(self::EXPECTED, $magentoVersion) <= 0) {
            $result['result_msg'] = self::SUCCESS_MSG;
            $result += ['result_code' => 'success'];
        } else {
            $result['result_msg'] = sprintf(
                self::FAILED_MSG,
                self::EXPECTED,
                $magentoVersion
            );
            $result +=
                [
                    'result_code' => 'failed',
                    'support_link' => self::SUPPORT_LINK
                ];
        }
        return $result;
    }
}
