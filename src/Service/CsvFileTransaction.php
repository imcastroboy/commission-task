<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Contract\FileTransaction;
use JACastro\CommissionTask\Entities\Transaction;

class CsvFileTransaction implements FileTransaction
{
    private $transactions = [];

    public function __construct(string $file)
    {
        if (!file_exists($file)) {
            throw new \Exception('File not found.');
        }

        if (!in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['csv'], true)) {
            throw new \Exception('File type not supported.');
        }

        if (($handle = fopen($file, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $this->transactions[] = new Transaction($data, new TransactionValidator());
            }

            fclose($handle);
        }
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
