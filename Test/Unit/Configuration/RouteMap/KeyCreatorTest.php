<?php

namespace Graycore\Daffodil\Test\Unit\Configuration\RouteMap;

use Graycore\Daffodil\Configuration\RouteMap\KeyCreator;
use PHPUnit\Framework\TestCase;

class KeyCreatorTest extends TestCase
{
    public function routeDataProvider()
    {
        return [
            ['null map', '', 'daffodil/routes/noop__index__index'],
            ['base case', '', 'daffodil/routes/noop__index__index'],
            ['happy path', 'customer/index/index', 'daffodil/routes/customer__index__index'],
            ['happy path', 'catalog/product/view', 'daffodil/routes/catalog__product__view'],

        ];
    }

    /**
     * @dataProvider routeDataProvider
     */
    public function testCreatingAConfigKeyFromARoute(string $case, string $key, string $result)
    {
        $subject = new KeyCreator();
        $this->assertEquals($result, $subject->create($key), $case);
    }
}
