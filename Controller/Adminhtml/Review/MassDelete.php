<?php

/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\Review;

use Exception;
use Magento\Backend\App\Action;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;
use Shopreviews\Connect\Api\Review\DataInterface;
use Shopreviews\Connect\Api\Review\RepositoryInterface;
use Shopreviews\Connect\Model\Review\CollectionFactory;

class MassDelete extends Action
{
    public const ADMIN_RESOURCE = 'Shopreviews_Connect::review_listing';

    private Filter $filter;
    private CollectionFactory $collectionFactory;
    private RepositoryInterface $reviewRepository;
    private LogRepository $logger;
    private RedirectInterface $redirect;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        RepositoryInterface $reviewRepository,
        RedirectInterface $redirect,
        LogRepository $logger
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->reviewRepository = $reviewRepository;
        $this->logger = $logger;
        $this->redirect = $redirect;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $review) {
                /** @var DataInterface $review */
                $this->reviewRepository->delete($review);
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $collectionSize)
            );
        } catch (LocalizedException $e) {
            $this->logger->addErrorLog('LocalizedException', $e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (Exception $e) {
            $this->logger->addErrorLog('Exception', $e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->resultRedirectFactory->create()
            ->setPath($this->redirect->getRefererUrl());
    }
}
