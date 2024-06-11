<?php

declare(strict_types=1);

namespace Tests;

use Iquety\Console\Arguments;
use Iquety\Console\Routine;
use Iquety\Console\Option;
use InvalidArgumentException;
use RuntimeException;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class RoutineImplementationsTest extends TestCase
{
    /** @test */
    public function routineInfo(): void
    {
        $routine = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
                $this->setName('routine-name');
                $this->setDescription('routine description');
                $this->setHowToUse('how to use description');

                // Por padrao, um comando tem uma opcao '-h' pré adicioada
                $this->addOption(new Option("-a", "--aaa", 'Option description', Option::OPTIONAL));
                $this->addOption(new Option("-b", "--bbb", 'Option description', Option::OPTIONAL));
            }

            protected function handle(Arguments $arguments): void
            {
                // $this->line("teste");
            }
        };

        $this->assertRoutineHasName("routine-name", $routine);
        $this->assertRoutineHasDescription("routine description", $routine);
        $this->assertRoutineHasHowToUse("how to use description", $routine);
        $this->assertCountRoutineOptions(3, $routine);

        $this->assertRoutineHasOption('-a', $routine);
        $this->assertRoutineHasOption('--aaa', $routine);
        $this->assertRoutineHasOption('-b', $routine);
        $this->assertRoutineHasOption('--bbb', $routine);
        $this->assertRoutineHasOption('-h', $routine);
        $this->assertRoutineHasOption('--help', $routine);
    }

    /** @test */
    public function implementationWithInvalidName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The name of a routine must be in kebab-case format. Example: routine-name");

        new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
                $this->setName('teste com espaço');
            }

            protected function handle(Arguments $arguments): void
            {
            }
        };
    }

    /** @test */
    public function implementationWithOption(): void
    {
        $object = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
                $this->setName('teste');
                $this->addOption(new Option("-p", "--port", 'Descricao opcao 1', Option::REQUIRED));
            }

            protected function handle(Arguments $arguments): void
            {
                $this->line("teste");
            }
        };

        $result = $this->gotcha($object, fn($terminal) => $terminal->run([ "-p", '8080' ]));

        $this->assertStringContainsString("teste", $result);
    }

    /** @test */
    public function implementationWithRequiredOption(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Required options: -p|--port');

        $object = new class ($this->terminalFactory()) extends Routine {
            protected function initialize(): void
            {
                $this->addOption(new Option("-p", "--port", 'Descricao opcao 1', Option::REQUIRED));
            }

            protected function handle(Arguments $arguments): void
            {
            }
        };

        $object->run([]);
    }
}
