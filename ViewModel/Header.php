<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\ViewModel;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;
use Shopreviews\Connect\Service\Schema\MarkupGenerator;
use Shopreviews\Connect\Api\Website\DataInterface as WebsiteData;

class Header implements ArgumentInterface
{

    private MarkupGenerator $markupGenerator;
    private ConfigRepository $configRepository;
    private Json $json;

    public function __construct(
        MarkupGenerator $markupGenerator,
        ConfigRepository $configRepository,
        Json $json
    ) {
        $this->markupGenerator = $markupGenerator;
        $this->configRepository = $configRepository;
        $this->json = $json;
    }

    /**
     * @param WebsiteData|null $website
     * @param array $reviews
     * @return bool|false|string
     */
    public function getStructuredData(?WebsiteData $website, array $reviews): ?string
    {
        if ($this->configRepository->showStructuredData() && $website) {
            return $this->json->serialize($this->markupGenerator->generateStructuredData($website, $reviews));
        }

        return null;
    }
}
