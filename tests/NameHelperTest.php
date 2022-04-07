<?php

use PHPUnit\Framework\TestCase;

final class NameHelperTest extends TestCase
{
    /**
     * @dataProvider normalizeNameProvider
     */
    public function testNormalizeName(string $name, string $expected): void
    {
        $helper = new NameHelper();

        $actual = $helper->normalizeName($name);

        $this->assertSame($expected, $actual);
    }

    public function normalizeNameProvider()
    {
        // name, normalized name
        yield ['Andriy Yun', 'Andriy Yun'];
        yield ['Andriy  Yun', 'Andriy Yun'];
        yield ['René', 'Rene'];
        yield ['Åge', 'Age'];
        yield ['Lærke', 'Laerke'];
        yield ['Anna-Margrete', 'Anna-Margrete'];
    }

    /**
     * @dataProvider compareNamesProvider
     */
    public function testCompareNames(string $name, string $expectedName, int $expected): void
    {
        $helper = new NameHelper();

        $actual = $helper->compareNames($name, $expectedName);

        $this->assertSame($expected, $actual);
    }

    public function compareNamesProvider()
    {
        // name, expected name, comparison result
        yield ['Andriy Yun', 'Andriy Yun', 0];
        yield ['Andriy  Yun', 'Andriy Yun', 0];
        yield ['René', 'Rene', 0];
        yield ['René', ' rene', 0];
        yield ['Åge', 'Age', 0];
        yield ['Lærke', 'Laerke', 0];
        yield ['Anna-Margrete', 'Anna', 0];
        yield ['Anna-Margrete', 'anna', 0];
    }
}
