<?php

declare(strict_types=1);

namespace Tests\FakeApp\ContextOne\src\Routines;

use Exception;
use Iquety\Console\Arguments;
use Iquety\Console\Routine;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ExampleException extends Routine
{
    public function initialize(): void
    {
        $this->setName("example-exception");

        $this->setDescription("Run the 'example-exception' routine");
    }

    protected function handle(Arguments $arguments): void
    {
        throw new Exception("Routine 'example-exception' threw exception");
    }
}
