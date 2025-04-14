<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\Source;

use Magento\Backend\App\Action;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Controller\ResultInterface;
use Shopreviews\Connect\Api\Request\RepositoryInterface as RequestRepository;
use Shopreviews\Connect\Service\SyncLog\Add as SyncLog;

class Sync extends Action
{

    public const ADMIN_RESOURCE = 'Shopreviews_Connect::review_listing';

    private RequestRepository $requestRepository;
    private SyncLog $syncLog;
    private RedirectInterface $redirect;

    public function __construct(
        Action\Context $context,
        RequestRepository $requestRepository,
        SyncLog $syncLog,
        RedirectInterface $redirect
    ) {
        $this->syncLog = $syncLog;
        $this->requestRepository = $requestRepository;
        $this->redirect = $redirect;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        try {
            $response = $this->requestRepository->syncAll();
            $this->syncLog->process($response, 'source');
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $this->resultRedirectFactory->create()
            ->setPath($this->redirect->getRefererUrl());
    }
}
