<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Abstracts;

interface ValidatorInterface
{
    public function isEmpty(string $value);

    public function validateOperationType(string $value);

    public function validateUserType(string $value);

    public function validateSupportedCurrencies(string $value);
}
