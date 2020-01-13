<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Config\Commission;
use JACastro\CommissionTask\Contract\Operationable;
use JACastro\CommissionTask\Contract\TransactionContract;

class CashInOperation extends Operation implements Operationable
{
    public function __construct(TransactionContract $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getCalculatedCommissionFee(): string
    {
        $totalFee = $this->calculateFee($this->transaction->amount(), Commission::CASH_IN_FEE);

        if ($this->conversionRate($totalFee) > Commission::MAX_CASH_IN_FEE) {
            return Commission::MAX_CASH_IN_FEE;
        }

        return $totalFee;
    }
}
