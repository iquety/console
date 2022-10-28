<?php

declare(strict_types=1);

namespace Tests\FakeApp\ContextTwo;

use Iquety\Console\Arguments;
use Iquety\Console\Command;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ExampleTwo extends Command
{
    protected function initialize(): void
    {
        $this->setName("very-very-very-more-very-long-command");
        $this->setDescription("Run the 'example2' command");
    }

    protected function handle(Arguments $arguments): void
    {
        // dispara saída padrão para o teste capturar
        $this->line("Command 'example2' executed");
    }
}
