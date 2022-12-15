<?php

namespace Graycore\Daffodil\Test\Unit\Configuration;

use Graycore\Daffodil\Configuration\RouteMap;
use Graycore\Daffodil\Configuration\RouteMap\KeyCreator;
use Magento\Framework\App\Config\ScopeConfigInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use PHPUnit\Framework\MockObject\MockObject;

class RouteMapTest extends TestCase
{
    public function routeMapProvider()
    {
        return [
            ['null map', '', null, ''],
            ['base case', '', '', ''],
            ['typical case', 'customer/index/index', 'dashboard', 'dashboard'],
        ];
    }

    /**
     * @dataProvider routeMapProvider
     */
    public function testItRetrievesMappingsFromTheRouteMap(
        string $case,
        ?string $route,
        ?string $map,
        string $result
    ) {
        /**
         * @var LoggerInterface|MockObject $logger
         */
        $logger = $this->createMock(LoggerInterface::class);

        /**
         * @var ScopeConfigInterface|MockObject $scopeConfig
         */
        $scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $scopeConfig->expects($this->once())->method('getValue')->willReturn($map);

        $subject = new RouteMap(
            $scopeConfig,
            $logger,
            new KeyCreator(),
        );


        $this->assertEquals(
            $result,
            $subject->getMappedRoute($route),
            $case
        );
    }

    public function testItLogsWhenTheresNoMapForARoute()
    {
        /**
         * @var LoggerInterface|MockObject $logger
         */
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())->method('info');

        /**
         * @var ScopeConfigInterface|MockObject $scopeConfig
         */
        $scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $scopeConfig->expects($this->once())->method('getValue')->willReturn(null);

        $subject = new RouteMap(
            $scopeConfig,
            $logger,
            new KeyCreator(),
        );

        $subject->getMappedRoute('no-route');
    }
}
