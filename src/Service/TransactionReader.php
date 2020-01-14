<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Abstracts\FileTransactionInterface;

class TransactionReader
{
    private $file;

    public function __construct(FileTransactionInterface $file)
    {
        $this->file = $file;
    }

    public function outputCalculatedCommissionFees()
    {
        $transactions = $this->file->getTransactions();

        foreach ($transactions as $transaction) {
            $commission = new CommissionCalculator($transaction, new Math(4));
            $transaction->setCommissionFee($commission->getCalculatedCommissionFee());

            echo number_format((float) $transaction->getCommissionFee(), 2, '.', '').PHP_EOL;
        }
    }
}
