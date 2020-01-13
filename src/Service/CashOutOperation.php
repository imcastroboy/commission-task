<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Config\Commission;
use JACastro\CommissionTask\Contract\Operationable;
use JACastro\CommissionTask\Contract\TransactionContract;

class CashOutOperation extends Operation implements Operationable
{
    public function __construct(TransactionContract $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getCalculatedCommissionFee(): string
    {
        $totalFee = $this->calculateFee($this->transaction->amount(), Commission::CASH_OUT_FEE);

        if ($this->isLegal() && $this->isLessMininumFee($totalFee)) {
            return Commission::MIN_LEGAL_PERSON_FEE;
        }

        return $totalFee;
    }

    public function isLessMininumFee(string $totalFee): bool
    {
        return $this->conversionRate($totalFee) < Commission::MIN_LEGAL_PERSON_FEE;
    }

    public function isLegal(): bool
    {
        return $this->transaction->userType() === 'legal';
    }
}
