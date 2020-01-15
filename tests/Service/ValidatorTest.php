<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Tests\Service;

use JACastro\CommissionTask\Abstracts\TransactionInterface;
use JACastro\CommissionTask\Entities\Transaction;
use JACastro\CommissionTask\Service\Math;
use JACastro\CommissionTask\Service\TransactionValidator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * @param Transaction $transaction
     *
     * @dataProvider dataProviderForUnsupportedCurrenciesTesting
     */
    public function testUnsupportedCurrency(TransactionInterface $transaction)
    {
        $this->expectException(\Exception::class);
        $transactionValidator = new TransactionValidator($transaction);
        $transactionValidator->validated();
    }

    /**
     * @param Transaction $transaction
     *
     * @dataProvider dataProviderForUnsupportedUserTypeTesting
     */
    public function testUnsupportedUserTypes(TransactionInterface $transaction)
    {
        $this->expectException(\Exception::class);
        $transactionValidator = new TransactionValidator($transaction);
        $transactionValidator->validated();
    }

    /**
     * @param Transaction $transaction
     *
     * @dataProvider dataProviderForUnsupportedOperationTypeTesting
     */
    public function testUnsupportedOperationTypes(TransactionInterface $transaction)
    {
        $this->expectException(\Exception::class);
        $transactionValidator = new TransactionValidator($transaction);
        $transactionValidator->validated();
        // $this->addToAssertionCount(1);
    }

    public function dataProviderForUnsupportedCurrenciesTesting(): array
    {
        $math = new Math(4);

        return [
            'get cash in commission' => [
                new Transaction(['2016-01-04', 4, 'natural', 'cash_in', '200', 'PHP'], $math),
                '0.06'
            ]
        ];
    }

    public function dataProviderForUnsupportedUserTypeTesting(): array
    {
        $math = new Math(4);

        return [
            'get cash in commission' => [
                new Transaction(['2016-01-04', 4, 'unsupported', 'cash_in', '200', 'USD'], $math),
                '0.06'
            ]
        ];
    }

    public function dataProviderForUnsupportedOperationTypeTesting(): array
    {
        $math = new Math(4);

        return [
            'get cash in commission' => [
                new Transaction(['2016-01-04', 4, 'legal', 'withdraw', '200', 'USD'], $math),
                '0.06'
            ]
        ];
    }
}
