<?php

declare(strict_types=1);

namespace Tests;

use Iquety\Console\Arguments;
use Iquety\Console\Routine;
use Iquety\Console\Option;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class RoutineExecutionTest extends TestCase
{
    /** @test */
    public function execution(): void
    {
        $object = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
                $this->setName("teste");
                $this->setDescription("Descrição da rotina");
                $this->addOption(new Option("-a", "--aaa", 'Descricao opcao 1', Option::OPTIONAL));
            }

            protected function handle(Arguments $arguments): void
            {
                $this->line($this->getName());
                $this->line($this->getDescription());
                $this->line("Total de " . count($this->getOptions()) . " opção");
                $this->line('executado');
            }
        };

        $result = $this->gotcha($object, fn($terminal) => $terminal->run([]));

        $this->assertStringContainsString("teste", $result);
        $this->assertStringContainsString("Total de 2 opção", $result);
        $this->assertStringContainsString("Descrição da rotina", $result);
        $this->assertStringContainsString("executado", $result);
    }

    /** @test */
    public function defaultDescriptionWithName(): void
    {
        $object = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
                $this->setName("teste");
            }

            protected function handle(Arguments $arguments): void
            {
                $this->line($this->getDescription());
            }
        };

        $result = $this->gotcha($object, fn($terminal) => $terminal->run([]));

        $this->assertStringContainsString("Run the 'teste' routine", $result);
    }

    /** @test */
    public function defaultDescriptionWithoutName(): void
    {
        $object = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
            }

            protected function handle(Arguments $arguments): void
            {
                $this->line($this->getDescription());
            }
        };

        $result = $this->gotcha($object, fn($terminal) => $terminal->run([]));

        $this->assertStringContainsString("Run the 'no-name' routine", $result);
    }
}
