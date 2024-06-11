<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

use Iquety\Console\Routine;
use PHPUnit\Framework\Constraint\Constraint;

class RoutineHasName extends Constraint
{
    protected string $expected;

    /** @param string $expected */
    public function __construct(string $expected)
    {
        $this->expected = $expected;
    }

    protected function methodToComparison(): string
    {
        return 'getName';
    }

    /**
     * Avalia a restrição para o argumento $other.
     * @param Routine $other
     */
    protected function matches($other): bool
    {
        if (! $other instanceof Routine) {
            return false;
        }

        $method = $this->methodToComparison();

        return $other->{$method}() === $this->expected;
    }

    /**
     * @param Routine $other
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function failureDescription($other): string
    {
        return 'an routine ' . $this->toString();
    }

    public function toString(): string
    {
        return "has name '$this->expected'";
    }
}
