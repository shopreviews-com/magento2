<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\Review;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Controller\ResultInterface;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;
use Shopreviews\Connect\Api\Review\RepositoryInterface as ReviewRepository;

/**
 * Delete single review from grid
 */
class Delete extends Action
{

    public const ADMIN_RESOURCE = 'Shopreviews_Connect::review_listing';

    private LogRepository $logRepository;
    private ReviewRepository $reviewRepository;
    private RedirectInterface $redirect;

    /**
     * Delete constructor.
     * @param Context $context
     * @param LogRepository $logRepository
     * @param ReviewRepository $reviewRepository
     * @param RedirectInterface $redirect
     */
    public function __construct(
        Action\Context $context,
        LogRepository $logRepository,
        ReviewRepository $reviewRepository,
        RedirectInterface $redirect
    ) {
        $this->logRepository = $logRepository;
        $this->reviewRepository = $reviewRepository;
        $this->redirect = $redirect;

        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $reviewId = (int)$this->getRequest()->getParam('review_id');

        try {
            $this->reviewRepository->deleteById($reviewId);
            $this->messageManager->addSuccessMessage(__('The review has been deleted.'));
        } catch (Exception $e) {
            $this->logRepository->addDebugLog('Delete review', $e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->resultRedirectFactory->create()
            ->setPath($this->redirect->getRefererUrl());
    }
}
