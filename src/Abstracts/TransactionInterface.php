<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Abstracts;

interface TransactionInterface
{
    public function operationDate(): string;

    public function userId(): string;

    public function userType(): string;

    public function operationType(): string;

    public function amount(): string;

    public function currency(): string;

    public function setCommissionFee(string $commission): string;

    public function getCommissionFee(): string;
}
