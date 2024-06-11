<?php

declare(strict_types=1);

namespace Tests;

use Iquety\Console\Routines\Help;
use Iquety\Console\Terminal;

class TerminalHelpTest extends TestCase
{
    /** @return array<int,string> */
    private function helpMessageLines(): array
    {
        return [
            "How to use:",
            "./example routine [options] [arguments]",

            "Options:",
            "-h, --help",
            "Display help information",

            "Available routines:",
            "help",
            "Display help information",
            "example-exception",
            "Run the 'example-exception' routine",
            "example1",
            "Run the 'example1' routine",
            "very-very-very-more-very-long-routine",
            "Run the 'example2' routine"
        ];
    }

    /** @return array<int,string> */
    private function routineHelpMessageLines(): array
    {
        return [
            "Routine: example1",
            "Run the 'example1' routine",
            "How to use:",
            "./example example1 [options]",
            "Options:",
            "-h, --help",
            "Display routine help",
            "-v, --very-very-very-more-very-long-option",
            "Descricao opcao 1"
        ];
    }

    /** @test */
    public function longDefaultHelpOption(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha(
            $terminal,
            fn(Terminal $terminal) => $terminal->run([ "--help" ])
        );

        foreach ($this->helpMessageLines() as $texto) {
            $this->assertStringContainsString($texto, $result);
        }
    }

    /** @test */
    public function shortDefaultHelpOption(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha(
            $terminal,
            fn(Terminal $terminal) => $terminal->run([ "-h" ])
        );

        $this->assertEquals(Help::class, $terminal->executedRoutine());

        foreach ($this->helpMessageLines() as $texto) {
            $this->assertStringContainsString($texto, $result);
        }
    }

    /** @test */
    public function longHelpOptionFromRoutine(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha(
            $terminal,
            fn(Terminal $terminal) => $terminal->run([ "example1", "--help" ])
        );

        foreach ($this->routineHelpMessageLines() as $texto) {
            $this->assertStringContainsString($texto, $result);
        }

        // com espacos de alinhamento
        $this->assertStringContainsString("  Descricao opcao 1\n", $result);

        // sem espacos de alinhamento
        $this->assertStringNotContainsString("          Descricao opcao 1\n", $result);
    }

    /** @test */
    public function shortHelpOptionFromRoutine(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha(
            $terminal,
            fn(Terminal $terminal) => $terminal->run([ "example1", "-h" ])
        );

        foreach ($this->routineHelpMessageLines() as $texto) {
            $this->assertStringContainsString($texto, $result);
        }
    }

    /** @test */
    public function helpRoutine(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha(
            $terminal,
            fn(Terminal $terminal) => $terminal->run([ "help" ])
        );

        $this->assertEquals(Help::class, $terminal->executedRoutine());

        foreach ($this->helpMessageLines() as $texto) {
            $this->assertStringContainsString($texto, $result);
        }
    }
}
