<?php

declare(strict_types=1);

namespace JACastro\CommissionTask\Abstracts;

interface MathInterface
{
    public function add(string $leftOperand, string $rightOperand): string;

    public function substract(string $leftOperand, string $rightOperand): string;

    public function multiply(string $leftOperand, string $rightOperand): string;

    public function divide(string $dividend, string $divisor): string;

    public function compare(string $leftOperand, string $rightOperand): int;
}
