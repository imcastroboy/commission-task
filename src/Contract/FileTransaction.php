<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Contract;

interface FileTransaction
{
    /**
     * List of converted list to Transaction.
     *
     * @return array List of Transaction
     */
    public function getTransactions(): array;
}
