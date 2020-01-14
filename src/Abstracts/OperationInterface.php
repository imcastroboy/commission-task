<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Abstracts;

interface OperationInterface
{
    /**
     * Final computation of commission fee based on
     * user type and cash in/out rules.
     *
     * @return float Computed commission fee
     */
    public function getCalculatedCommissionFee(): string;
}
