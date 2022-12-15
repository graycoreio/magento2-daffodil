<?php

namespace Graycore\Daffodil\Test\Unit\Router;

use Graycore\Daffodil\Router\RouteNormalizer;
use PHPUnit\Framework\TestCase;

class RouteNormalizerTest extends TestCase
{
    /**
     * Data for the test.
     */
    public function routeTestProvider()
    {
        return [
            ['', 'index/index/index'],
            ['customer', 'customer/index/index'],
            ['change_password', 'change_password/index/index'],
            ['cms', 'cms/index/index'],
            ['cms?test=1', 'cms/index/index'],
            ['cms?test=1', 'cms/index/index'],
            ['cms#test1', 'cms/index/index'],
            ['cms?test=1#test1', 'cms/index/index'],
            ['customer/account', 'customer/account/index'],
            ['customer/account', 'customer/account/index'],
            ['customer/account', 'customer/account/index'],
            ['/customer/account', 'customer/account/index'],
            ['customer/account?test=1', 'customer/account/index'],
            ['customer/account?test=1', 'customer/account/index'],
            ['customer/account#test1', 'customer/account/index'],
            ['customer/account?test=1#test1', 'customer/account/index'],
            ['customer/account/confirm', 'customer/account/confirm'],
            ['catalog/product/view/id/1', 'catalog/product/view'],
            ['catalog/product/view/id/1?test=1', 'catalog/product/view'],
            ['catalog/product/view/id/1?test=1', 'catalog/product/view'],
            ['catalog/product/view/id/1#test1', 'catalog/product/view'],
            ['catalog/product/view/id/1?test=1#test1', 'catalog/product/view'],
            ['https://www.domain.com/catalog/product/view/id/1?test=1#test1', 'catalog/product/view'],
        ];
    }

    /**
     * @dataProvider routeTestProvider
     */
    public function testItNormalizesRoutesCorrectly(string $route, string $result)
    {
        $this->assertEquals(RouteNormalizer::normalize($route), $result);
    }

    /**
     * Data for the test.
     */
    public function routePathData()
    {
        return [
            ['', ''],
            ['customer', 'customer'],
            ['change_password', 'change_password'],
            ['cms', 'cms'],
            ['cms?test=1', 'cms'],
            ['cms?test=1', 'cms'],
            ['cms#test1', 'cms'],
            ['cms?test=1#test1', 'cms'],
            ['customer/account', 'customer/account'],
            ['customer/account', 'customer/account'],
            ['customer/account', 'customer/account'],
            ['/customer/account', 'customer/account'],
            ['customer/account?test=1', 'customer/account'],
            ['customer/account?test=1', 'customer/account'],
            ['customer/account#test1', 'customer/account'],
            ['customer/account?test=1#test1', 'customer/account'],
            ['customer/account/confirm', 'customer/account/confirm'],
            ['catalog/product/view/id/1', 'catalog/product/view'],
            ['catalog/product/view/id/1?test=1', 'catalog/product/view'],
            ['catalog/product/view/id/1?test=1', 'catalog/product/view'],
            ['catalog/product/view/id/1#test1', 'catalog/product/view'],
            ['catalog/product/view/id/1?test=1#test1', 'catalog/product/view'],
            ['http://www.domain.com/catalog/product/view/id/1?test=1#test1', 'catalog/product/view'],
        ];
    }

    /**
     * @dataProvider routePathData
     */
    public function testItComputesTheCorrectRouteStringFromThePath(string $path, string $result)
    {
        return $this->assertEquals(
            RouteNormalizer::getRouteStringFromPath($path),
            $result
        );
    }
}
