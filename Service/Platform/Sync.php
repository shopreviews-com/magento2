<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\Platform;

use Magento\Framework\Exception\AuthenticationException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shopreviews\Connect\Api\Platform\DataInterface as PlatformData;
use Shopreviews\Connect\Api\Platform\RepositoryInterface as PlatformRepository;
use Shopreviews\Connect\Service\Api\Adapter;

class Sync
{
    public int $updated = 0;
    public int $new = 0;
    private Adapter $adapter;
    private PlatformRepository $platformRepository;

    public function __construct(
        Adapter $adapter,
        PlatformRepository $platformRepository
    ) {
        $this->adapter = $adapter;
        $this->platformRepository = $platformRepository;
    }

    /**
     * @throws LocalizedException
     */
    public function execute(): array
    {
        $platforms = $this->getPlatforms();

        foreach ($platforms['data'] as $platformData) {
            $platform = $this->loadSavedPlatform($platformData['uuid'])
                ->setName($platformData['name'])
                ->setLogo($platformData['imageUrl'])
                ->setLogoIcon($platformData['iconUrl'])
                ->setIsActive((bool)$platformData['is_active'])
                ->setCreatedAt($platformData['created_at'])
                ->setUpdatedAt($platformData['updated_at']);
            $this->platformRepository->save($platform);
        }

        return [
            'success' => true,
            'new' => $this->new,
            'updated' => $this->updated
        ];
    }

    /**
     * @return array
     * @throws LocalizedException
     * @throws AuthenticationException
     */
    private function getPlatforms(): array
    {
        return $this->adapter->execute(Adapter::API_PLATFORMS);
    }

    /**
     * @param string $platformUuid
     * @return PlatformData
     * @throws LocalizedException
     */
    private function loadSavedPlatform(string $platformUuid): PlatformData
    {
        try {
            $source = $this->platformRepository->getByUuid($platformUuid);
            $this->updated++;
        } catch (NoSuchEntityException $exception) {
            $source = $this->platformRepository->create()->setPlatformUuid($platformUuid);
            $this->new++;
        }
        return $source;
    }
}
