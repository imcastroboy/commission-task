<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Entities;

use JACastro\CommissionTask\Contract\TransactionContract;
use JACastro\CommissionTask\Contract\Validator;

class Transaction implements TransactionContract
{
    private $transaction;
    private $validator;

    public function __construct(array $transaction, Validator $validator)
    {
        $this->transaction = $transaction;
        $this->validator = $validator;
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
