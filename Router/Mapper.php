<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Router;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Graycore\Daffodil\Configuration\Configuration;
use Graycore\Daffodil\Configuration\RouteMap;

class Mapper
{

    private $_configuration;
    private $_routeMap;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(Configuration $configuration, RouteMap $routeMap)
    {
        $this->_configuration = $configuration;
        $this->_routeMap = $routeMap;
    }

    public function mapRoute(string $url, string $route)
    {
        return str_replace($route, $this->_routeMap->getMappedRoute($route), $url);
    }

    public function mapDomain($url, $domain)
    {
        return str_replace($domain, $this->_configuration->getdaffodilurl(), $url);
    }
}
