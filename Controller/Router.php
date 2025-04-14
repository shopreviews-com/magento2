<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Url;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;

/**
 * URL rewrite for the front page
 */
class Router implements RouterInterface
{

    protected ActionFactory $actionFactory;
    protected ConfigRepository $configRepository;

    public function __construct(
        ActionFactory $actionFactory,
        ConfigRepository $configRepository
    ) {
        $this->actionFactory = $actionFactory;
        $this->configRepository = $configRepository;
    }

    /**
     *
     * @param RequestInterface $request
     * @return ActionInterface|bool
     */
    public function match(RequestInterface $request)
    {
        if (!$urlPath = $this->getUrlPath()) {
            return false;
        }

        $identifier = trim($request->getPathInfo(), '/');
        $path = explode('/', $identifier, 5);

        if (isset($path[0]) && ($path[0] != $urlPath)) {
            return false;
        }

        if (isset($path[1]) && $path[1] != 'page' && $path[1] != 'filters') {
            return false;
        }

        $pageIndex = array_search('page', $path);
        $filterIndex = array_search('filters', $path);
        $params = [];

        if ($pageIndex && isset($path[$pageIndex + 1]) && is_numeric($path[$pageIndex + 1])) {
            $params['page'] = $path[$pageIndex + 1];
        }
        if ($filterIndex && isset($path[$filterIndex + 1])) {
            $params['filters'] = $path[$filterIndex + 1];
        }

        $request->setModuleName('shopreviews_com')
            ->setControllerName('review')
            ->setActionName('index');

        if (count($params)) {
            $request->setParams($params);
        }

        $request->setAlias(Url::REWRITE_REQUEST_PATH_ALIAS, $identifier);

        return $this->actionFactory->create(Forward::class);
    }

    /**
     * @return string|null
     */
    private function getUrlPath(): ?string
    {
        return $this->configRepository->getUrlPath();
    }
}
