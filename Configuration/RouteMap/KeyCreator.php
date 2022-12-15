<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Configuration\RouteMap;

class KeyCreator
{
    const MAP_CONFIG_PATH = "daffodil/routes/";
    const NOOP_ROUTE = "noop__index__index";

    /**
     * Create a configuration key for a given route.
     */
    public function create($route)
    {
        if (!$route) {
            $route = self::NOOP_ROUTE;
        }

        // We may need to remove the trailing slash from the route to form the key path.
        $route = rtrim($route, "/");

        return self::MAP_CONFIG_PATH . str_replace('/', '__', $route);
    }
}
