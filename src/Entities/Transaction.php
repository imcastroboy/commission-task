<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Entities;

use JACastro\CommissionTask\Abstracts\MathInterface;
use JACastro\CommissionTask\Abstracts\TransactionInterface;
use JACastro\CommissionTask\Abstracts\ValidatorInterface;
use JACastro\CommissionTask\Config\App;

class Transaction implements TransactionInterface
{
    private $transaction;
    private $validator;
    private $math;

    public function __construct(
        array $transaction,
        ValidatorInterface $validator,
        MathInterface $math
    ) {
        $this->transaction = $transaction;
        $this->validator = $validator;
        $this->math = $math;
    }

    public function operationDate(): string
    {
        $this->validator->isEmpty($this->transaction[0]);

        return $this->transaction[0];
    }

    public function userId(): string
    {
        $this->validator->isEmpty($this->transaction[1]);

        return $this->transaction[1];
    }

    public function userType(): string
    {
        $this->validator->isEmpty($this->transaction[2]);
        $this->validator->validateUserType($this->transaction[2]);

        return $this->transaction[2];
    }

    public function operationType(): string
    {
        $this->validator->isEmpty($this->transaction[3]);
        $this->validator->validateOperationType($this->transaction[3]);

        return $this->transaction[3];
    }

    public function amount(): string
    {
        $this->validator->isEmpty($this->transaction[4]);

        return $this->transaction[4];
    }

    public function currency(): string
    {
        $this->validator->isEmpty($this->transaction[5]);
        $this->validator->validateSupportedCurrencies($this->transaction[5]);

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
        $this->validator->isEmpty($commission);

        return $this->transaction[6] = $commission;
    }

    public function getCommissionFee(): string
    {
        $this->validator->isEmpty($this->transaction[6]);

        return $this->transaction[6];
    }
}
