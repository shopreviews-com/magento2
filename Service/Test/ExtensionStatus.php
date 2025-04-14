<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Test;

use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;

/**
 * Extension status test class
 */
class ExtensionStatus
{

    public const TYPE = 'extension_status';
    public const TEST = 'Check if the extension is enabled in the configuration';
    public const VISIBLE = true;
    public const SUCCESS_MSG = 'Extension is enabled';
    public const FAILED_MSG = 'Extension disabled, please enable it!';
    public const EXPECTED = true;

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
            'visible' => self::VISIBLE
        ];

        if ($this->configRepository->isEnabled() == self::EXPECTED) {
            $result['result_msg'] = self::SUCCESS_MSG;
            $result +=
                [
                    'result_code' => 'success',
                ];
        } else {
            $result['result_msg'] = self::FAILED_MSG;
            $result +=
                [
                    'result_code' => 'failed',
                ];
        }
        return $result;
    }
}
