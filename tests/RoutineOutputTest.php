<?php

declare(strict_types=1);

namespace Tests;

use Iquety\Console\Arguments;
use Iquety\Console\Routine;
use Iquety\Console\Option;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class RoutineOutputTest extends TestCase
{
    /** @test */
    public function printHelp(): void
    {
        $objeto = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
                $this->setName("routine-name");
                $this->setDescription("Help information");
            }

            protected function handle(Arguments $arguments): void
            {
                $this->error("exibida mensagem de erro");
            }
        };

        $result = $this->gotcha($objeto, fn(Routine $routine) => $routine->run([ '-h' ]));

        $expected = [
            "\nRoutine: routine-name",
            " Help information\n",
            "\nOptions:",
            "-h, --help",
            "           Display routine help\n", // com espacos de alinhamento
        ];

        foreach ($expected as $snippet) {
            $this->assertStringContainsString($snippet, $result);
        }
    }

    /** @test */
    public function printHelpWithLongFlag(): void
    {
        $objeto = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
                $this->setName("routine-name");
                $this->setDescription("Routine with long option");

                $this->addOption(new Option(
                    "-v",
                    "--very-very-very-more-very-long-option",
                    'Descricao opcao 1',
                    Option::OPTIONAL
                ));
            }

            protected function handle(Arguments $arguments): void
            {
                $this->error("exibida mensagem de erro");
            }
        };

        $result = $this->gotcha($objeto, fn(Routine $routine) => $routine->run([ '-h' ]));

        $expected = [
            "\nRoutine: routine-name",
            " Routine with long option\n",
            "\nOptions:",
            "-h, --help",
            "           Display routine help\n",
            "-v, --very-very-very-more-very-long-option",
            "  Descricao opcao 1\n", // sem espacos de alinhamento
        ];

        foreach ($expected as $snippet) {
            $this->assertStringContainsString($snippet, $result);
        }

        // sem espacos de alinhamento
        $this->assertStringNotContainsString("          Descricao opcao 1\n", $result);
    }

    /** @test */
    public function executionWithTextPrint(): void
    {
        $objeto = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
            }


            protected function handle(Arguments $arguments): void
            {
                $this->line("exibida mensagem de texto");
            }
        };

        $result = $this->gotcha($objeto, fn(Routine $routine) => $routine->run([]));

        $this->assertEquals("exibida mensagem de texto\n", $result);
    }

    /** @test */
    public function executionWithErrorPrint(): void
    {
        $objeto = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
            }

            protected function handle(Arguments $arguments): void
            {
                $this->error("exibida mensagem de erro");
            }
        };

        $result = $this->gotcha($objeto, fn(Routine $routine) => $routine->run([]));

        $this->assertEquals("\033[0;31m✗ exibida mensagem de erro\033[0m\n", $result);
    }

    /** @test */
    public function executionWithInfoPrint(): void
    {
        $objeto = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
            }

            protected function handle(Arguments $arguments): void
            {
                $this->info("exibida mensagem informativa");
            }
        };

        $result = $this->gotcha($objeto, fn(Routine $routine) => $routine->run([]));

        $this->assertEquals("\033[0;34m➜ exibida mensagem informativa\033[0m\n", $result);
    }

    /** @test */
    public function executionWithWarningPrint(): void
    {
        $objeto = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
            }

            protected function handle(Arguments $arguments): void
            {
                $this->warning("exibida mensagem de alerta");
            }
        };

        $result = $this->gotcha($objeto, fn(Routine $routine) => $routine->run([]));

        $this->assertEquals("\033[0;33m✱ exibida mensagem de alerta\033[0m\n", $result);
    }
}
