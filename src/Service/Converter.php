<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Config\Rate;

class Converter
{
    private $math;
    private $rate;

    public function __construct(Math $math, Rate $rate)
    {
        $this->math = $math;
        $this->rate = $rate();
    }

    public function convertRateTo(string $amount, string $currency): string
    {
        return $this->math->multiply($amount, $this->rate);
    }

    public function convertRateFrom(string $amount, string $currency)
    {
        return $this->math->divide($amount, $this->rate);
    }
}
