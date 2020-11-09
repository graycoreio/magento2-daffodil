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
    /**
     * ROUTE MAPPING
     */
    const CREATE_PASSWORD_ROUTE = "daffodil/routes/change_password";
    const ACCOUNT_ROUTE = "daffodil/routes/account";

    private $_scopeConfig;

    private $_map = [
        "customer/account/createPassword/" => self::CREATE_PASSWORD_ROUTE,
        "customer/account/" => self::ACCOUNT_ROUTE
    ];

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
    }

    public function getMappedRoute($route)
    {
        try {
            return $this->_scopeConfig->getValue(
                $this->_map[$route],
                ScopeInterface::SCOPE_STORE
            );
        } catch (\Exception $e) {
            return $route;
        }
    }
}
