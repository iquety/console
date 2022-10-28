<?php

declare(strict_types=1);

namespace Tests\FakeApp\ContextOne\src\Commands;

use Exception;
use Iquety\Console\Arguments;
use Iquety\Console\Command;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ExampleException extends Command
{
    public function initialize(): void
    {
        $this->setName("example-exception");
        $this->setDescription("Run the 'example-exception' command");
    }

    protected function handle(Arguments $arguments): void
    {
        throw new Exception("Command 'example-exception' threw exception");
    }
}
