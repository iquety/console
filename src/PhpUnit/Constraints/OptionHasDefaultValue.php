<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class OptionHasDefaultValue extends OptionHasShortNotation
{
    public function toString(): string
    {
        return "has default value '$this->expected'";
    }
    protected function methodToComparison(): string
    {
        return 'getDefaultValue';
    }
}
