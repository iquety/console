<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class OptionHasLongNotation extends OptionHasShortNotation
{
    public function toString(): string
    {
        return "has long notation '$this->expected'";
    }
    protected function methodToComparison(): string
    {
        return 'getLongNotation';
    }
}
