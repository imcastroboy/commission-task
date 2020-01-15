<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Entities;

use JACastro\CommissionTask\Abstracts\MathInterface;
use JACastro\CommissionTask\Abstracts\TransactionInterface;
use JACastro\CommissionTask\Config\App;

class Transaction implements TransactionInterface
{
    private $transaction;
    private $validator;
    private $math;

    public function __construct(
        array $transaction,
        MathInterface $math
    ) {
        $this->transaction = $transaction;
        $this->math = $math;
    }

    public function operationDate(): string
    {
        return $this->transaction[0];
    }

    public function userId(): string
    {
        return $this->transaction[1];
    }

    public function userType(): string
    {
        return $this->transaction[2];
    }

    public function operationType(): string
    {
        return $this->transaction[3];
    }

    public function amount(): string
    {
        return $this->transaction[4];
    }

    public function currency(): string
    {
        return $this->transaction[5];
    }

    public function convertedAmount()
    {
        return $this->math->multiply(
            $this->amount(),
            App::CURRENCY_RATES[strtoupper($this->currency())]
        );
    }

    public function setCommissionFee(string $commission): string
    {
        return $this->transaction[6] = $commission;
    }

    public function getCommissionFee(): string
    {
        return $this->transaction[6];
    }

    public function getAttributes()
    {
        return $this->transaction;
    }
}
