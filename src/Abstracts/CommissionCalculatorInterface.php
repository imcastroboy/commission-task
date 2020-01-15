<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Abstracts;

interface CommissionCalculatorInterface
{
    public function getCalculatedCommissionFee(): string;

    public function calculateFee(string $commissionFee): string;

    public function convertCommissionFee(string $fee): string;
}
