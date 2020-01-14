<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Service;

use JACastro\CommissionTask\Abstracts\MathInterface;

class Math implements MathInterface
{
    private $scale;

    public function __construct(int $scale)
    {
        $this->scale = $scale;
    }

    public function add(string $leftOperand, string $rightOperand): string
    {
        return bcadd($leftOperand, $rightOperand, $this->scale);
    }

    public function substract(string $leftOperand, string $rightOperand): string
    {
        return bcsub($leftOperand, $rightOperand, $this->scale);
    }

    public function multiply(string $leftOperand, string $rightOperand): string
    {
        return bcmul($leftOperand, $rightOperand, $this->scale);
    }

    public function divide(string $dividend, string $divisor): string
    {
        return bcdiv($dividend, $divisor, $this->scale);
    }

    public function compare(string $leftOperand, string $rightOperand): int
    {
        return bccomp($leftOperand, $rightOperand, $this->scale);
    }
}
