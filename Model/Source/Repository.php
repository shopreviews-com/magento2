<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Source;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;
use Shopreviews\Connect\Api\Source\DataInterface;
use Shopreviews\Connect\Api\Source\RepositoryInterface as SourceRepositoryInterface;

/**
 * Shopreviews source repository class
 */
class Repository implements SourceRepositoryInterface
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

        $source = $this->dataFactory->create();
        $this->resourceModel->load($source, $entityId);

        if (!$source->getId()) {
            throw new NoSuchEntityException(__('No such entity with ID %1.', $entityId));
        }

        return $source;
    }

    /**
     * @inheritDoc
     */
    public function getByUuid(string $uuid): DataInterface
    {
        if (empty($uuid)) {
            throw new InputException(__('Invalid UUID.'));
        }

        $source = $this->dataFactory->create();
        $this->resourceModel->load($source, $uuid, DataInterface::SOURCE_UUID);

        if (!$source->getId()) {
            throw new NoSuchEntityException(__('No such entity with UUID %1.', $uuid));
        }

        return $source;
    }

    /**
     * @inheritDoc
     */
    public function save(DataInterface $source): DataInterface
    {
        try {
            $this->resourceModel->save($source);
        } catch (Exception $exception) {
            $this->logRepository->addErrorLog('Save source', $exception->getMessage());
            throw new CouldNotSaveException(__('Could not save the entity: %1', $exception->getMessage()));
        }

        return $source;
    }

    /**
     * @inheritDoc
     */
    public function delete(DataInterface $source): bool
    {
        try {
            $this->resourceModel->delete($source);
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
    public function getByWebsite(?string $websiteUuid): Collection
    {
        $collection = $this->collectionFactory->create();
        if (!empty($websiteUuid)) {
            $this->applyWebsiteUuidFilter($collection, $websiteUuid);
        }

        return $collection;
    }

    /**
     * Applies a filter to the collection based on website UUIDs.
     *
     * @param Collection $collection The source collection.
     * @param string $websiteUuid The website UUID to filter by.
     * @return void
     */
    private function applyWebsiteUuidFilter(Collection $collection, string $websiteUuid): void
    {
        $connection = $this->resourceModel->getConnection();
        $condition = $connection->quoteInto(
            'JSON_CONTAINS(website_uuids, ?)',
            $this->json->serialize($websiteUuid)
        );

        $collection->getSelect()->where($condition);
    }
}
