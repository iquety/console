<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class RoutineHasHowToUse extends RoutineHasName
{
    protected function methodToComparison(): string
    {
        return 'getHowToUse';
    }

    public function toString(): string
    {
        return "has how to use '$this->expected'";
    }
}
