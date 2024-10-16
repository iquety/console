<?php

declare(strict_types=1);

namespace Tests;

use Iquety\Console\Terminal;
use InvalidArgumentException;
use Iquety\Console\Routines\Help;
use Tests\FakeApp\ContextOne\src\Routines\ExampleOne;
use Tests\FakeApp\ContextTwo\ExampleTwo;

class TerminalTest extends TestCase
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

    /** @test */
    public function constructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The specified application directory does not exist');

        new Terminal(__DIR__ . "/NotExists");
    }

    /** @test */
    public function loadRoutinesFromException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $terminal = new Terminal(__DIR__ . "/FakeApp");
        $terminal->loadRoutinesFrom("/caminho-inexistente");
    }

    /** @test */
    public function withoutArguments(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha($terminal, fn($terminal) => $terminal->run([]));

        $this->assertEquals(Help::class, $terminal->executedRoutine());
        $this->assertEquals(Terminal::STATUS_SUCCESS, $terminal->executedStatus());

        $this->assertStringContainsString('How to use:', $result);
    }

    /** @test */
    public function nonExistentRoutine(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha($terminal, fn($terminal) => $terminal->run([ "blabla" ]));

        $this->assertEquals("no", $terminal->executedRoutine());
        $this->assertEquals(Terminal::STATUS_NOT_FOUND, $terminal->executedStatus());

        foreach ($this->helpMessageLines() as $texto) {
            $this->assertStringContainsString($texto, $result);
        }
    }

    /** @test */
    public function exampleRoutineOne(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha($terminal, fn($terminal) => $terminal->run([ "example1" ]));

        $this->assertEquals(ExampleOne::class, $terminal->executedRoutine());
        $this->assertEquals(Terminal::STATUS_SUCCESS, $terminal->executedStatus());

        $this->assertStringContainsString("Routine 'example1' executed", $result);
    }

    /** @test */
    public function exampleRoutineTwo(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha(
            $terminal,
            fn($terminal) => $terminal->run([ "very-very-very-more-very-long-routine" ])
        );

        $this->assertEquals(ExampleTwo::class, $terminal->executedRoutine());
        $this->assertEquals(Terminal::STATUS_SUCCESS, $terminal->executedStatus());

        $this->assertStringContainsString("Routine 'example2' executed", $result);
    }

    /** @test */
    public function exampleRoutineException(): void
    {
        $terminal = $this->terminalFactory();

        $result = $this->gotcha($terminal, fn($terminal) => $terminal->run([ "example-exception" ]));

        $this->assertEquals("no", $terminal->executedRoutine());
        $this->assertEquals(Terminal::STATUS_ERROR, $terminal->executedStatus());

        $this->assertStringContainsString("Routine 'example-exception' threw exception", $result);
    }

    /** @test */
    public function exampleRoutineBadImplementation(): void
    {
        $terminal = $this->terminalFactory();
        $terminal->loadRoutinesFrom(__DIR__ . "/FakeApp/ContextThree");

        $result = $this->gotcha($terminal, fn($terminal) => $terminal->run([ "bug" ]));

        $this->assertEquals("no", $terminal->executedRoutine());
        $this->assertEquals(Terminal::STATUS_ERROR, $terminal->executedStatus());

        $this->assertStringContainsString("Unable to extract namespace from file", $result);
    }

    /** @test */
    public function exampleRoutineClassWithInvalidName(): void
    {
        $terminal = $this->terminalFactory();
        $terminal->loadRoutinesFrom(__DIR__ . "/FakeApp/ContextFour");

        $result = $this->gotcha($terminal, fn($terminal) => $terminal->run([ "example4" ]));

        $this->assertEquals("no", $terminal->executedRoutine());
        $this->assertEquals(Terminal::STATUS_ERROR, $terminal->executedStatus());

        $this->assertStringContainsString(
            "The file '" . __DIR__ . "/FakeApp/ContextFour/ExampleFour.php' " .
            "not contains a 'Tests\FakeApp\ContextTwo\ExampleFour' class",
            $result
        );
    }
}
