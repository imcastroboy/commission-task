<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Abstracts\CommissionCalculatorInterface;
use JACastro\CommissionTask\Abstracts\TransactionInterface;
use JACastro\CommissionTask\Config\App;

class CommissionCalculator implements CommissionCalculatorInterface
{
    private $transaction;
    private $math;

    public function __construct(TransactionInterface $transaction, Math $math)
    {
        $this->transaction = $transaction;
        $this->math = $math;
    }

    public function getCalculatedCommissionFee(): string
    {
        $cashFee = $this->transaction->operationType() === 'cash_in'
            ? App::COMMISSION_CASH_IN_FEE
            : App::COMMISSION_CASH_OUT_FEE;
        $totalFee = $this->calculateFee($cashFee);

        if ($this->isLegalAndLessMinFeeCashOut($totalFee)) {
            return App::COMMISSION_MIN_LEGAL_PERSON_FEE;
        }

        if ($this->isMoreThanMaximumFeeCashIn($totalFee)) {
            return App::COMMISSION_MAX_CASH_IN_FEE;
        }

        return $totalFee;
    }

    public function calculateFee(string $commissionFee): string
    {
        $result = $this->math->multiply($this->transaction->amount(), $commissionFee);

        return $result;
    }

    private function isLegalAndLessMinFeeCashOut(string $totalFee): bool
    {
        return $this->transaction->operationType() === 'cash_out'
            && $this->isLegal()
            && $this->isLessThanMininumFee($totalFee);
    }

    private function isLessThanMininumFee(string $totalFee): bool
    {
        return $this->math->compare(
            $this->convertCommissionFee($totalFee),
            App::COMMISSION_MIN_LEGAL_PERSON_FEE
        ) === -1;
    }

    private function isMoreThanMaximumFeeCashIn(string $totalFee): bool
    {
        return $this->transaction->operationType() === 'cash_in'
            && $this->math->compare(
                $this->convertCommissionFee($totalFee),
                App::COMMISSION_MAX_CASH_IN_FEE
            ) === 1;
    }

    private function isLegal(): bool
    {
        return $this->transaction->userType() === 'legal';
    }

    public function convertCommissionFee(string $fee): string
    {
        return $this->math->multiply(
            $fee,
            App::CURRENCY_RATES[strtoupper($this->transaction->currency())]
        );
    }
}
