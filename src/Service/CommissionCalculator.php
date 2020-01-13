<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Contract\TransactionContract;

class CommissionCalculator
{
    protected $transaction;

    public function __construct(TransactionContract $transaction)
    {
        $this->transaction = $transaction;
    }

    public function calculate()
    {
        $operationType = $this->transaction->operationType();

        if ($operationType === 'cash_out') {
            $commission = new CashOutOperation($this->transaction);
        } elseif ($operationType === 'cash_in') {
            $commission = new CashInOperation($this->transaction);
        }

        $this->transaction->setCommissionFee($commission->getCalculatedCommissionFee());

        return $this->transaction;
    }
}
