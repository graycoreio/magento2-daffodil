<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Configuration;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class RouteMap
 *
 * @package Graycore\Daffodil\Configuration
 */
class RouteMap
{

    const MAP_CONFIG_PATH = "daffodil/routes/";

    private $_scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
    }

    private function createConfigKey($route)
    {
        // We need to remove the trailing slash from the route to form the key path.
        if (substr($route, -1) === "/") {
            $route = substr($route, 0, -1)
        }
        
        return str_replace('/', '_', strtolower($route));
    }

    public function getMappedRoute($route)
    {
        try {
            return $this->_scopeConfig->getValue(
                $this->createConfigKey($route),
                ScopeInterface::SCOPE_STORE
            );
        } catch (\Exception $e) {
            return $route;
        }
    }
}
