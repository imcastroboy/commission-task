<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Config\Rate;

class Operation
{
    private $transation;

    public function conversionRate(string $amount)
    {
        $converter = new Converter(new Math(4), new Rate($this->transaction->currency()));
        $convertedRate = $converter->convertRateTo($amount, $this->transaction->currency());

        return $convertedRate;
    }

    public function formatOutput($result)
    {
        return $result;
        // return number_format((float) $result, 2, '.', '');
    }

    public function calculateFee($amount, $commissionFee)
    {
        $math = new Math(4);
        $result = $math->multiply($amount, $commissionFee);

        return $result;
    }
}
