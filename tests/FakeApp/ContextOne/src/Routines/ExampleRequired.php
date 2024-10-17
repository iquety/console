<?php

declare(strict_types=1);

namespace Tests\FakeApp\ContextOne\src\Routines;

use Iquety\Console\Arguments;
use Iquety\Console\Routine;
use Iquety\Console\Option;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ExampleRequired extends Routine
{
    protected function initialize(): void
    {
        $this->setName("example-required");
        $this->setDescription("Run the 'example-required' routine");
        $this->setHowToUse("./example example-required [options]");

        $this->addOption(new Option(
            "-v",
            "--very-very-very-more-very-long-option",
            'Descricao opcao 1',
            Option::REQUIRED | Option::VALUED
        ));
    }

    protected function handle(Arguments $arguments): void
    {
        // dispara saída padrão para o teste capturar
        $this->line("Routine 'example-required' executed");
    }
}
