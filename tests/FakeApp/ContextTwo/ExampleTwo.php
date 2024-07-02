<?php

declare(strict_types=1);

namespace Tests\FakeApp\ContextTwo;

use Iquety\Console\Arguments;
use Iquety\Console\Routine;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ExampleTwo extends Routine
{
    protected function initialize(): void
    {
        $this->setName("very-very-very-more-very-long-routine");

        $this->setDescription("Run the 'example2' routine");
    }

    protected function handle(Arguments $arguments): void
    {
        // dispara saída padrão para o teste capturar
        $this->line("Routine 'example2' executed");
    }
}
