<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class OptionIsBoolean extends OptionIsRequired
{
    protected function methodToComparison(): string
    {
        return 'isBoolean';
    }

    public function toString(): string
    {
        return "is boolean";
    }
}
