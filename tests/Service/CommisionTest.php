<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use JACastro\CommissionTask\Service\CommissionCalculator;
use JACastro\CommissionTask\Entities\Transaction;
use JACastro\CommissionTask\Service\TransactionValidator;

class CommissionTest extends TestCase
{
    /**
     * @param Transaction $transaction
     * @param string $expectation
     *
     * @dataProvider dataProviderForCommissionTesting
     */
    public function testCommission(Transaction $transaction, string $expectation)
    {
        $commission = new CommissionCalculator($transaction);
        $transaction = $commission->calculate();

        $this->assertEquals(
            $expectation,
            $transaction->getCommissionFee()
        );
    }

    public function dataProviderForCommissionTesting(): array
    {
        $validator = new TransactionValidator();

        return [
            'get cash in commission' => [
                new Transaction(['2016-01-04', 4, 'natural', 'cash_in', '200', 'EUR'], $validator),
                '0.06'
            ],
            'get cash in commission with more then 5 EUR' => [new Transaction(['2016-01-04', 4, 'natural', 'cash_in', '1000000', 'EUR'], $validator), '5.00'],
            'get cash in commission in USD' => [new Transaction(['2016-01-04', 4, 'natural', 'cash_in', '200', 'USD'], $validator), '0.06'],
            'get natural user cash out commission' => [new Transaction(['2016-01-01', 1, 'natural', 'cash_out', '1200', 'EUR'], $validator), '3.60'],
            'get legal user cash out commission' => [new Transaction(['2016-01-01', 1, 'legal', 'cash_out', '300', 'EUR'], $validator), '0.90'],
            'get legal user cash out commission with less than 0.50' => [new Transaction(['2016-01-01', 1, 'legal', 'cash_out', '100', 'EUR'], $validator), '0.50'],
        ];
    }
}
