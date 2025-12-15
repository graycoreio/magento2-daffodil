<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Router;

use Laminas\Uri\UriFactory;

class RouteNormalizer
{
    public const FAKE_DOMAIN = "http://www.example.com";

    /**
     * Normalizes a route into a well-formed Magento route path.
     *
     * I.e. `customer` -> `customer/index/index`
     *
     * @param string $path
     * @return string
     */
    public static function normalize(string $path): string
    {
        $url = self::coercePathToUri($path);
        $url = UriFactory::factory($url);

        $routeParts = explode('/', ltrim($url->getPath(), '/'), 4);

        $parts = [];

        //Handle nulls
        $routeParts[0] = $routeParts[0] ?? 'index';
        $routeParts[1] = $routeParts[1] ?? 'index';
        $routeParts[2] = $routeParts[2] ?? 'index';

        //Handle possibly falsy values like empty strings.
        $parts[0] = $routeParts[0] ?: 'index';
        $parts[1] = $routeParts[1] ?: 'index';
        $parts[2] = $routeParts[2] ?: 'index';

        return implode('/', $parts);
    }

    /**
     * Retrieves the router-relevant portion of the uri.
     *
     * @param string $url
     * @return string
     */
    public static function getRouteStringFromPath(string $url): string
    {
        $url = self::coercePathToUri($url);
        $url = UriFactory::factory($url);

        $routeParts = explode('/', ltrim($url->getPath(), '/'), 4);
        $parts = [];

        $parts[0] = $routeParts[0] ?? '';
        $parts[1] = $routeParts[1] ?? '';
        $parts[2] = $routeParts[2] ?? '';

        return rtrim(implode('/', $parts), '/');
    }

    /**
     * Takes a path, and coerces it to a URI.
     *
     * @param string $path
     * @return string
     */
    public static function coercePathToUri(string $path): string
    {
        return strpos($path, "http") !== 0
            ? self::FAKE_DOMAIN . '/' . $path
            : $path;
    }
}
