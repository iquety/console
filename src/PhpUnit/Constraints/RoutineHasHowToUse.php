<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class RoutineHasHowToUse extends RoutineHasName
{
    public function toString(): string
    {
        return "has how to use '$this->expected'";
    }
    protected function methodToComparison(): string
    {
        return 'getHowToUse';
    }
}
