<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Contract;

interface Validator
{
    public function isEmpty(string $value);

    public function validateOperationType(string $value);

    public function validateUserType(string $value);

    public function validateSupportedCurrencies(string $value);
}
