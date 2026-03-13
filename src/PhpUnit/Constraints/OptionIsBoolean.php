<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class OptionIsBoolean extends OptionIsRequired
{
    public function toString(): string
    {
        return 'is boolean';
    }
    protected function methodToComparison(): string
    {
        return 'isBoolean';
    }
}
