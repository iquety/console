<?php

declare(strict_types=1);

// namespace inválido de propósito
namespace Tests\FakeApp\ContextTwo;

use Iquety\Console\Arguments;
use Iquety\Console\Routine;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ExampleFourInvalid extends Routine // nome da classe diferente do arquivo
{
    protected function initialize(): void
    {
        $this->setName("example4");

        $this->setDescription("Run the 'example2' routine");
    }

    protected function handle(Arguments $arguments): void
    {
        // dispara saída padrão para o teste capturar
        $this->line("Routine 'example2' executed");
    }
}
