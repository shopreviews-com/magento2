<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller\Review;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Url\DecoderInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;

class Index extends Action implements HttpGetActionInterface, HttpPostActionInterface
{

    private PageFactory $pageFactory;
    private ConfigRepository $configRepository;
    private DecoderInterface $decoder;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ConfigRepository $configRepository,
        DecoderInterface $decoder
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->configRepository = $configRepository;
        $this->decoder = $decoder;
    }

    /**
     * Executes the controller action.
     *
     * @return ResultInterface Page result or redirect response.
     */
    public function execute(): ResultInterface
    {
        $page = $this->pageFactory->create();
        if ($layout = $this->configRepository->getLayoutUpdate()) {
            $page->getConfig()->setPageLayout($layout);
        }

        $this->assignMetaData($page);

        if ($filter = $this->getRequest()->getParam('filters', false)) {
            $this->resolveFilters((string)$filter);
        }

        return $page;
    }

    /**
     * Assigns metadata to the page.
     *
     * @param Page $page The page instance to assign metadata.
     * @return void
     */
    private function assignMetaData(Page $page): void
    {
        $pageConfig = $page->getConfig();
        $pageConfig->getTitle()->set($this->configRepository->getPageTitle());
        $pageConfig->setDescription($this->configRepository->getMetaDescription());
        $pageConfig->setKeywords($this->configRepository->getMetaKeywords());
        $pageConfig->addRemotePageAsset(
            $this->getCanonicalUrl(),
            'canonical',
            ['attributes' => ['rel' => 'canonical']]
        );
    }

    /**
     * Generates the canonical URL for the page.
     *
     * @return string The canonical URL.
     */
    private function getCanonicalUrl(): string
    {
        $filters = $this->getRequest()->getParam('filters', false);
        $page = $this->getRequest()->getParam('page', false);

        if (($filters && $page) || ($page && (int)$page > 1)) {
            return $this->_url->getUrl('shopreviews_com') . 'page/' . $page . '/';
        }

        return $this->_url->getUrl('shopreviews_com');
    }

    /**
     * Decodes and applies filter parameters to the request.
     *
     * @param string $filters Encoded filter string.
     * @return void
     */
    private function resolveFilters(string $filters): void
    {
        $decodedFilters = $this->decoder->decode($filters);
        $filtersArray = $this->parseQueryString($decodedFilters);

        foreach ($filtersArray as $key => $value) {
            if (!empty($value)) {
                $this->getRequest()->setParams([$key => $value]);
            }
        }
    }

    /**
     * Safely parses a query string into an associative array.
     *
     * @param string $queryString The query string to parse.
     * @return array Parsed query parameters as an associative array.
     */
    private function parseQueryString(string $queryString): array
    {
        $result = [];
        $pairs = explode('&', $queryString);

        foreach ($pairs as $pair) {
            $keyValue = explode('=', $pair, 2);
            if (isset($keyValue[0]) && isset($keyValue[1])) {
                $result[urldecode($keyValue[0])] = urldecode($keyValue[1]);
            }
        }

        return $result;
    }
}
