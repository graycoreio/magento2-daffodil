<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Router;

use Graycore\Daffodil\Configuration\Configuration;
use Graycore\Daffodil\Configuration\RouteMap;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Graycore\Daffodil\Router\RouteNormalizer;

class Mapper
{
    /**
     * @var Configuration
     */
    private $_configuration;

    /**
     * @var RouteMap
     */
    private $_routeMap;

    /**
     * @param Configuration $configuration
     * @param RouteMap $routeMap
     */
    public function __construct(Configuration $configuration, RouteMap $routeMap)
    {
        $this->_configuration = $configuration;
        $this->_routeMap = $routeMap;
    }

    /**
     * Map, as generally as plausible, to a known mapped route in configuration.
     *
     * For example, this would map  "customer/index/index" to "some-path" if the
     * `$route` was "customer" and the resulting map for "customer" returned
     * "some-path".
     *
     * @param string $url
     * @param string $route
     * @return string
     */
    public function mapRoute(string $url, string $route)
    {
        $norm = RouteNormalizer::normalize($route);

        if (!$this->_routeMap->getMappedRoute($norm)) {
            return $url;
        }

        return str_replace(
            RouteNormalizer::getRouteStringFromPath($url),
            $this->_routeMap->getMappedRoute($norm),
            $url
        );
    }

    /**
     * Map domain to Daffodil URL.
     *
     * @param string $url
     * @param string $domain
     * @return string
     */
    public function mapDomain($url, $domain)
    {
        return str_replace($domain, $this->_configuration->getDaffodilUrl(), $url);
    }
}
