<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Website;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;
use Shopreviews\Connect\Api\Website\DataInterface;
use Shopreviews\Connect\Api\Website\RepositoryInterface as WebsiteRepositoryInterface;

/**
 * Shopreviews website repository class
 */
class Repository implements WebsiteRepositoryInterface
{

    private ResourceModel $resourceModel;
    private DataFactory $dataFactory;
    private CollectionFactory $collectionFactory;
    private LogRepository $logRepository;
    private Json $json;

    public function __construct(
        ResourceModel $resourceModel,
        DataFactory $dataFactory,
        CollectionFactory $collectionFactory,
        LogRepository $logRepository,
        Json $json
    ) {
        $this->resourceModel = $resourceModel;
        $this->dataFactory = $dataFactory;
        $this->collectionFactory = $collectionFactory;
        $this->logRepository = $logRepository;
        $this->json = $json;
    }

    /**
     * @inheritDoc
     */
    public function create(): DataInterface
    {
        return $this->dataFactory->create();
    }

    /**
     * @inheritDoc
     */
    public function get(int $entityId): DataInterface
    {
        if ($entityId <= 0) {
            throw new InputException(__('Invalid entity ID.'));
        }

        $website = $this->dataFactory->create();
        $this->resourceModel->load($website, $entityId);

        if (!$website->getId()) {
            throw new NoSuchEntityException(__('No such entity with ID %1.', $entityId));
        }

        return $website;
    }

    /**
     * @inheritDoc
     */
    public function getByUuid(string $uuid): DataInterface
    {
        if (empty($uuid)) {
            throw new InputException(__('Invalid UUID.'));
        }

        $website = $this->dataFactory->create();
        $this->resourceModel->load($website, $uuid, DataInterface::WEBSITE_UUID);

        if (!$website->getId()) {
            throw new NoSuchEntityException(__('No such entity with UUID %1.', $uuid));
        }

        return $website;
    }

    /**
     * @inheritDoc
     */
    public function save(DataInterface $website): DataInterface
    {
        try {
            $this->resourceModel->save($website);
        } catch (Exception $exception) {
            $this->logRepository->addErrorLog('Save source', $exception->getMessage());
            throw new CouldNotSaveException(__('Could not save the entity: %1', $exception->getMessage()));
        }

        return $website;
    }

    /**
     * @inheritDoc
     */
    public function delete(DataInterface $website): bool
    {
        try {
            $this->resourceModel->delete($website);
        } catch (Exception $exception) {
            $this->logRepository->addErrorLog('Delete source', $exception->getMessage());
            throw new CouldNotDeleteException(__('Could not delete the entity: %1', $exception->getMessage()));
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $entityId): bool
    {
        return $this->delete($this->get($entityId));
    }

    /**
     * @inheritDoc
     */
    public function deleteByUuid(string $uuid): bool
    {
        return $this->delete($this->getByUuid($uuid));
    }

    /**
     * @inheritDoc
     */
    public function getAllActive(): Collection
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(DataInterface::IS_ACTIVE, true);

        return $collection;
    }
}
