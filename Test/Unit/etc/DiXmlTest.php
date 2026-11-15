<?php

namespace Graycore\Daffodil\Test\Unit\etc;

use Graycore\Daffodil\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

class DiXmlTest extends TestCase
{
    public function testEmailVariableListsTheConfiguredDaffodilUrlPath(): void
    {
        $di = simplexml_load_file(__DIR__ . '/../../../etc/di.xml');
        $items = $di->xpath(
            '//type[@name="Magento\Variable\Model\Config\Structure\AvailableVariables"]'
            . '//argument[@name="configPaths"]//item[@name="daffodil/configuration"]/item'
        );
        $paths = array_map(static fn ($item) => (string)$item['name'], $items);

        $this->assertContains(Configuration::DAFFODIL_URL, $paths);
    }
}
