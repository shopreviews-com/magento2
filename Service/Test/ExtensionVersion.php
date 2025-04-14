<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Test;

use Exception;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;

class ExtensionVersion
{

    public const TYPE = 'extension_version';
    public const TEST = 'Check if new extension version is available';
    public const VISIBLE = true;
    public const SUCCESS_MSG = 'Great, you are using the latest version.';
    public const FAILED_MSG = 'Version %s is available, current version %s';
    public const EXPECTED = [-1, 0];
    public const SUPPORT_LINK = 'https://www.magmodules.eu/help/magento2/update-extension.html';

    private JsonFactory $resultJsonFactory;
    private ConfigRepository $configRepository;
    private JsonSerializer $json;
    private File $file;
    private LogRepository $logRepository;

    public function __construct(
        JsonFactory $resultJsonFactory,
        ConfigRepository $configRepository,
        LogRepository $logRepository,
        JsonSerializer $json,
        File $file
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->configRepository = $configRepository;
        $this->logRepository = $logRepository;
        $this->json = $json;
        $this->file = $file;
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
        $extensionVersion = preg_replace('/^v/', '', $this->configRepository->getExtensionVersion());
        try {
            $data = $this->file->fileGetContents(
                sprintf('https://version.magmodules.eu/%s.json', ConfigRepository::EXTENSION_CODE)
            );
        } catch (Exception $e) {
            $this->logRepository->addErrorLog('Extension version test', $e->getMessage());
            $result['result_msg'] = self::SUCCESS_MSG;
            $result += ['result_code' => 'success'];
            return $result;
        }

        $data = $this->json->unserialize($data);
        $versions = array_keys($data);
        $latest = preg_replace('/^v/', '', reset($versions));

        if (in_array(version_compare($latest, $extensionVersion), self::EXPECTED)) {
            $result['result_msg'] = self::SUCCESS_MSG;
            $result +=
                [
                    'result_code' => 'success'
                ];
        } else {
            $result['result_msg'] = sprintf(
                self::FAILED_MSG,
                'v' . $latest,
                'v' . $extensionVersion
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
