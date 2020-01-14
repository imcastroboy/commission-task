<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Abstracts;

interface FileTransactionInterface
{
    /**
     * List of converted list to Transaction.
     *
     * @return array List of Transaction
     */
    public function getTransactions(): array;
}
