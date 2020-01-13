<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Contract\FileTransaction;

class TransactionReader
{
    private $file;

    public function __construct(FileTransaction $file)
    {
        $this->file = $file;
    }

    public function outputCalculatedCommissionFees()
    {
        $transactions = $this->file->getTransactions();

        foreach ($transactions as $transaction) {
            $commission = new CommissionCalculator($transaction);
            $transaction = $commission->calculate();

            echo number_format((float) $transaction->getCommissionFee(), 2, '.', '').PHP_EOL;
        }
    }
}
