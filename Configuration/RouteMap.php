<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Configuration;

use Graycore\Daffodil\Configuration\RouteMap\KeyCreator;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Maps Routes that exist in Magento to potentially custom routes that exist in the Daffodil PWA.
 */
class RouteMap
{
    /**
     * @var ScopeConfigInterface
     */
    private $_scopeConfig;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var KeyCreator
     */
    private $_keyCreator;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param \Psr\Log\LoggerInterface $logger
     * @param KeyCreator $keyCreator
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Psr\Log\LoggerInterface $logger,
        KeyCreator $keyCreator
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->logger = $logger;
        $this->_keyCreator = $keyCreator;
    }

    /**
     * Retrieve the relevant path for a given route.
     *
     * Routes are assumed to be Magento controller-like URIs, i.e.,
     * - customer
     * - customer/index
     * - customer/index/index
     * - customer/test
     *
     * @param string $route
     * @return string|null
     */
    public function getMappedRoute(string $route): ?string
    {
        $key = $this->_keyCreator->create($route);
        try {
            $mapping = $this->_scopeConfig->getValue(
                $key,
                ScopeInterface::SCOPE_STORE
            );
            if (!$mapping) {
                $this->logger->info("`
                    Daffodil PWA EMAIL: No PWA route mapping for {$route}. 
                    Consider adding a custom configuration key for {$key}
                `");
            }
            return $mapping;
        } catch (\Exception $e) {
            return $route;
        }
    }
}
