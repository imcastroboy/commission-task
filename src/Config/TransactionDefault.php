<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Config;

class TransactionDefault
{
    private $userTypes = ['natural', 'legal'];
    private $operationTypes = ['cash_in', 'cash_out'];

    public function getUserTypes(): array
    {
        return $this->userTypes;
    }

    public function getOperationTypes(): array
    {
        return $this->operationTypes;
    }
}
