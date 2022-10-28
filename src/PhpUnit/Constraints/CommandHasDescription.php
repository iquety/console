<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit\Constraints;

class CommandHasDescription extends CommandHasName
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
