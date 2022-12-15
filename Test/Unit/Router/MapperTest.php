<?php

namespace Graycore\Daffodil\Test\Unit\Router;

use Graycore\Daffodil\Configuration\Configuration;
use Graycore\Daffodil\Configuration\RouteMap;
use Graycore\Daffodil\Router\Mapper;
use PHPUnit\Framework\TestCase;

class MapperTest extends TestCase
{
    public function routeTestProvider()
    {
        return [
            [
                //No Mapping, but matches, happy path
                'https://www.domain.com/customer/index/index',
                'customer/index/index', null,
                'https://www.domain.com/customer/index/index'
            ],
            [
                //No Mapping, but GetUrl is odd.
                'https://www.domain.com/',
                'customer/index/index', null,
                'https://www.domain.com/'
            ],
            [
                //Mapping, but GetUrl is odd.
                'https://www.domain.com/',
                'customer/index/index', 'test123',
                'https://www.domain.com/'
            ],
            [
                //Mapping, GetUrl works, happy path.
                'https://www.domain.com/customer/index/index',
                'customer', 'some-path',
                'https://www.domain.com/some-path'
            ],
            [
                //Short form #1
                'https://www.domain.com/customer/index/index',
                'customer', 'some-path',
                'https://www.domain.com/some-path'
            ],
            [
                'https://www.domain.com/customer',
                'customer', 'some-path',
                'https://www.domain.com/some-path'
            ],
            [
                'https://www.domain.com/customer/account/index',
                'customer/account', 'my-account',
                'https://www.domain.com/my-account'
            ],
            [
                'https://www.domain.com/customer/account',
                'customer/account', 'my-account',
                'https://www.domain.com/my-account'
            ],
            [
                //Short form #1
                'https://www.domain.com/change_password/index/index',
                'change_password', 'auth/reset-password',
                'https://www.domain.com/auth/reset-password'
            ],
            [
                //Short form #2
                'https://www.domain.com/customer/index/index',
                'customer/index', 'some-path',
                'https://www.domain.com/some-path'
            ],
            [
                //Long form
                'https://www.domain.com/customer/index/index',
                'customer/index/index', 'some-path',
                'https://www.domain.com/some-path'
            ],
            [
                //Long form with query string
                'https://www.domain.com/customer/account/createPassword/?token=123',
                'customer/account/createPassword', 'auth/reset-password',
                'https://www.domain.com/auth/reset-password/?token=123'
            ],
            [
                'https://www.domain.com/customer/account/confirm/?key=test123&id=123',
                'customer/account/confirm', 'auth/confirmation',
                'https://www.domain.com/auth/confirmation/?key=test123&id=123'
            ],
            [
                //Short form, no match.
                'https://www.domain.com/customer/account/createPassword/?token=12345',
                'customer/account/createPassword', 'auth/reset-password',
                'https://www.domain.com/auth/reset-password/?token=12345'
            ],
            [
                'https://www.domain.com/catalog/product/view/id/1/?token=12345',
                'catalog/product/view', null,
                'https://www.domain.com/catalog/product/view/id/1/?token=12345'
            ],
            [
                'https://www.domain.com/catalog/product/view/id/1/?token=12345',
                'catalog/product/view', 'category',
                'https://www.domain.com/category/id/1/?token=12345'
            ],
        ];
    }

    /**
     * @dataProvider routeTestProvider
     */
    public function testItMapsRoutesCorrectly(string $url, string $route, ?string $map, string $result)
    {
        $routeMap = $this->createMock(RouteMap::class);
        $routeMap->method('getMappedRoute')->willReturn($map);

        $subject = new Mapper(
            $this->createMock(Configuration::class),
            $routeMap
        );

        $this->assertEquals($result, $subject->mapRoute($url, $route));
    }
}
