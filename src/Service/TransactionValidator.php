<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Abstracts\TransactionInterface;
use JACastro\CommissionTask\Abstracts\ValidatorInterface;
use JACastro\CommissionTask\Config\App;

class TransactionValidator implements ValidatorInterface
{
    private $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function validated(): TransactionInterface
    {
        foreach ($this->transaction->getAttributes() as $transaction) {
            $this->isEmpty($transaction);
        }

        $this->validateOperationType($this->transaction->operationType());
        $this->validateUserType($this->transaction->userType());
        $this->validateSupportedCurrencies($this->transaction->currency());

        return $this->transaction;
    }

    public function isEmpty($value)
    {
        if (!isset($value) || $value === '') {
            throw new \Exception('Empty value.');
        }
    }

    public function validateOperationType(string $value)
    {
        if (!in_array($value, App::OPERATION_TYPES, true)) {
            throw new \Exception(sprintf('%s is not a valid operation type.', $value));
        }
    }

    public function validateUserType(string $value)
    {
        if (!in_array($value, App::USER_TYPES, true)) {
            throw new \Exception(sprintf('%s is not a valid user type.', $value));
        }
    }

    public function validateSupportedCurrencies(string $value)
    {
        $currencies = array_map('strtolower', array_keys(App::CURRENCY_RATES));

        if (!in_array(strtolower($value), $currencies, true)) {
            throw new \Exception(sprintf('%s currency is not supported.', $value));
        }
    }
}
