<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Adminhtml\Selftest;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Shopreviews\Connect\Api\Selftest\RepositoryInterface as SelftestRepository;

class Index extends Action
{

    private JsonFactory $resultJsonFactory;
    private SelftestRepository $selftestRepository;

    public function __construct(
        Action\Context $context,
        JsonFactory $resultJsonFactory,
        SelftestRepository $selftestRepository
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->selftestRepository = $selftestRepository;
        parent::__construct($context);
    }

    /**
     * @return Json
     */
    public function execute(): Json
    {
        $resultJson = $this->resultJsonFactory->create();
        $result = $this->selftestRepository->test();
        return $resultJson->setData(['result' => $result]);
    }
}
