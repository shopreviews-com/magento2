<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Review;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;
use Shopreviews\Connect\Api\Review\DataInterface;
use Shopreviews\Connect\Api\Review\RepositoryInterface as ReviewRepositoryInterface;

/**
 * Shopreviews review repository class
 */
class Repository implements ReviewRepositoryInterface
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

        $review = $this->dataFactory->create();
        $this->resourceModel->load($review, $entityId);

        if (!$review->getId()) {
            throw new NoSuchEntityException(__('No such entity with ID %1.', $entityId));
        }

        return $review;
    }

    /**
     * @inheritDoc
     */
    public function getByUuid(string $uuid): DataInterface
    {
        if (empty($uuid)) {
            throw new InputException(__('Invalid UUID.'));
        }

        $review = $this->dataFactory->create();
        $this->resourceModel->load($review, $uuid, DataInterface::REVIEW_UUID);

        if (!$review->getId()) {
            throw new NoSuchEntityException(__('No such entity with UUID %1.', $uuid));
        }

        return $review;
    }

    /**
     * @inheritDoc
     */
    public function save(DataInterface $review): DataInterface
    {
        try {
            $this->resourceModel->save($review);
        } catch (Exception $exception) {
            $this->logRepository->addErrorLog('Save review', $exception->getMessage());
            throw new CouldNotSaveException(__('Could not save the entity: %1', $exception->getMessage()));
        }

        return $review;
    }

    /**
     * @inheritDoc
     */
    public function delete(DataInterface $review): bool
    {
        try {
            $this->resourceModel->delete($review);
        } catch (Exception $exception) {
            $this->logRepository->addErrorLog('Delete review', $exception->getMessage());
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
    public function getBySources(?array $sourceUuids, ?int $pageSize = 10, ?int $page = 1): Collection
    {
        /* @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(DataInterface::SOURCE_UUID, ['in' => $sourceUuids])
            ->setOrder(DataInterface::REVIEW_DATE)
            ->setPageSize($pageSize)
            ->setCurPage($page);

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function getTopReviewsBySources(array $sourceUuids, ?int $limit = 10): Collection
    {
        if (empty($sourceUuids)) {
            return $this->collectionFactory->create();
        }

        $topReviewIds = [];
        foreach ($sourceUuids as $sourceUuid) {
            $sourceReviews = $this->collectionFactory->create()
                ->addFieldToFilter(DataInterface::SOURCE_UUID, $sourceUuid)
                ->setOrder(DataInterface::REVIEW_DATE, 'DESC')
                ->setPageSize($limit);

            $topReviewIds = [...$topReviewIds, ...$sourceReviews->getColumnValues(DataInterface::REVIEW_UUID)];
        }

        if (empty($topReviewIds)) {
            return $this->collectionFactory->create(); // Return an empty collection
        }

        /* @var Collection $collection */
        $collection = $this->collectionFactory->create()
            ->addFieldToFilter(DataInterface::REVIEW_UUID, ['in' => $topReviewIds])
            ->setOrder(DataInterface::REVIEW_DATE, 'DESC');

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function getYearsRange(): array
    {
        // Create a new collection instance
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect(DataInterface::REVIEW_DATE)
            ->getSelect()
            ->group(new \Zend_Db_Expr("YEAR(" . DataInterface::REVIEW_DATE . ")"))
            ->order(DataInterface::REVIEW_DATE . ' DESC');

        return $collection->getItems();
    }

    /**
     * @inheritDoc
     */
    public function getRatingsRange(): array
    {
        // Create a new collection instance
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect(DataInterface::RATING)
            ->getSelect()
            ->group(DataInterface::RATING)
            ->order(DataInterface::RATING . ' ASC');

        return $collection->getItems();
    }
}
