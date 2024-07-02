<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

use Iquety\Console\Routine;
use PHPUnit\Framework\Constraint\Constraint;

class RoutineCountOptions extends Constraint
{
    protected int $expectedCount;

    /** @param int $expectedCount */
    public function __construct(int $expectedCount)
    {
        $this->expectedCount = $expectedCount;
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

        return count($other->getOptions()) === $this->expectedCount;
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
        return sprintf('options count matches %d', $this->expectedCount);
    }
}
