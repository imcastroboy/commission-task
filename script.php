<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use JACastro\CommissionTask\Service\CsvFileTransaction;
use JACastro\CommissionTask\Service\TransactionReader;

if (isset($argc)) {
    if (!isset($argv[1])) {
        throw new Exception('File parameter not supplied.');
    }

    $csv = new CsvFileTransaction($argv[1]);
    $transaction = new TransactionReader($csv);

    $transaction->outputCalculatedCommissionFees();
} else {
    throw new Exception('Argument not enable.');
}
