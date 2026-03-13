<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class OptionIsValued extends OptionIsRequired
{
    public function toString(): string
    {
        return 'is valued';
    }
    protected function methodToComparison(): string
    {
        return 'isValued';
    }
}
