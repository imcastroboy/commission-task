<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Config;

class Rate
{
    private $rates = [
        'EUR' => '1.0',
        'USD' => '1.1497',
        'JPY' => '129.53',
    ];

    private $currency;

    public function __construct(string $currency = null)
    {
        $this->currency = $currency;
    }

    public function __invoke()
    {
        return $this->rates[$this->currency];
    }

    public function getRates()
    {
        return $this->rates;
    }
}
