<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class OptionHasDescription extends OptionHasShortNotation
{
    public function toString(): string
    {
        return "has description '$this->expected'";
    }
    protected function methodToComparison(): string
    {
        return 'getDescription';
    }
}
