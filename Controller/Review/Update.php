<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Review;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Shopreviews\Connect\ViewModel\Reviews;

/**
 * Ajax controller to load reviews data
 */
class Update extends Action
{

    protected ResultFactory $resultJsonFactory;
    private Reviews $viewModel;

    public function __construct(
        Context $context,
        ResultFactory $resultJsonFactory,
        Reviews $viewModel
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->viewModel = $viewModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create(ResultFactory::TYPE_JSON);

        return $resultJson->setData(['reviews' => [
            'filters' => $this->viewModel->getEnabledFilters(),
            'data' => $this->viewModel->getReviews(),
            'pagination' => $this->viewModel->getPaginationData(),
        ]]);
    }
}
