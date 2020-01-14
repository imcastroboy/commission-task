<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use JACastro\CommissionTask\Config\App;
use JACastro\CommissionTask\Service\Math;

class RateTest extends TestCase
{
    /**
     * @var Math
     */
    private $math;

    public function setUp()
    {
        $this->math = new Math(4);
    }

    /**
     * @param string $currency
     * @param string $amount
     * @param string $expectation
     *
     * @dataProvider dataProviderForRateTesting
     */
    public function testRate(string $currency, string $amount, string $expectation)
    {
        $rate = App::CURRENCY_RATES[$currency];
        $convertion = $this->math->multiply($rate, $amount);

        $this->assertEquals(
            $expectation,
            $convertion
        );
    }

    public function dataProviderForRateTesting(): array
    {
        return [
            'get conversion rate for EUR' => ['EUR', '1', '1'],
            'get USD conversation rate to EUR' => ['USD', '1', '1.1497'],
            'get JPY conversation rate to EUR' => ['JPY', '1', '129.53'],
            'get float USD number conversation rate to EUR' => ['USD', '10.5', '12.0718'],
            'get float JPY number conversation rate to EUR' => ['JPY', '3000.37', '388637.9261'],
        ];
    }
}
