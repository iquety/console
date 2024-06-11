<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class RoutineHasDescription extends RoutineHasName
{
    protected function methodToComparison(): string
    {
        return 'getDescription';
    }

    public function toString(): string
    {
        return "has description '$this->expected'";
    }
}
