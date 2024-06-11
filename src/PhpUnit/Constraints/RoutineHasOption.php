<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

use Iquety\Console\Routine;
use PHPUnit\Framework\Constraint\Constraint;

class RoutineHasOption extends Constraint
{
    protected string $expected;

    /** @param string $expected */
    public function __construct(string $expected)
    {
        $this->expected = $expected;
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

        $optionList = $other->getOptions();

        foreach ($optionList as $option) {
            if (
                $option->getShortNotation() === $this->expected
                || $option->getLongNotation() === $this->expected
            ) {
                return true;
            }
        }

        return false;
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
        return "has option '$this->expected'";
    }
}
