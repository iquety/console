<?php

declare(strict_types=1);

namespace Tests\FakeApp\ContextOne\src\Routines;

use Iquety\Console\Arguments;
use Iquety\Console\Routine;
use Iquety\Console\Option;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ExampleOne extends Routine
{
    protected function initialize(): void
    {
        $this->setName("example1");
        $this->setDescription("Run the 'example1' routine");
        $this->setHowToUse("./example example1 [options]");

        $this->addOption(new Option(
            "-v",
            "--very-very-very-more-very-long-option",
            'Descricao opcao 1',
            Option::OPTIONAL
        ));
    }

    protected function handle(Arguments $arguments): void
    {
        // dispara saída padrão para o teste capturar
        $this->line("Routine 'example1' executed");
    }
}
