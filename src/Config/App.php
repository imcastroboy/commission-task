<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Config;

class App
{
    const COMMISSION_CASH_IN_FEE = '0.0003';
    const COMMISSION_CASH_OUT_FEE = '0.003';
    const COMMISSION_MAX_CASH_IN_FEE = '5.00';
    const COMMISSION_MIN_LEGAL_PERSON_FEE = '0.50';
    const CURRENCY_RATES = [
        'EUR' => '1.0',
        'USD' => '1.1497',
        'JPY' => '129.53',
    ];
    const USER_TYPES = ['legal', 'natural'];
    const OPERATION_TYPES = ['cash_in', 'cash_out'];
}
