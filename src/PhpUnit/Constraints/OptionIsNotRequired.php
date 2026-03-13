<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

use Iquety\Console\Option;

class OptionIsNotRequired extends OptionIsRequired
{
    public function toString(): string
    {
        return 'is not required';
    }
    /**
     * Avalia a restrição para o argumento $other.
     * @param Option $other
     */
    protected function matches($other): bool
    {
        return parent::matches($other) === false;
    }
}
