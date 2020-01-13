<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Config\Rate;
use JACastro\CommissionTask\Config\TransactionDefault;
use JACastro\CommissionTask\Contract\Validator;

class TransactionValidator implements Validator
{
    private $defaults;
    private $rates;

    public function __construct()
    {
        $this->defaults = new TransactionDefault();
        $this->rates = new Rate();
    }

    public function isEmpty(string $value)
    {
        if (!isset($value) || $value === '') {
            throw new \Exception('Empty value.');
        }
    }

    public function validateOperationType(string $value)
    {
        if (!in_array($value, $this->defaults->getOperationTypes(), true)) {
            throw new \Exception(sprintf('%s is not a valid operation type.', $value));
        }
    }

    public function validateUserType(string $value)
    {
        if (!in_array($value, $this->defaults->getUserTypes(), true)) {
            throw new \Exception(sprintf('%s is not a valid user type.', $value));
        }
    }

    public function validateSupportedCurrencies(string $value)
    {
        $currencies = array_map('strtolower', array_keys($this->rates->getRates()));

        if (!in_array(strtolower($value), $currencies, true)) {
            throw new \Exception(sprintf('%s currency is not supported.', $value));
        }
    }
}
