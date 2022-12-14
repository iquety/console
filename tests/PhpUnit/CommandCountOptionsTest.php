<?php

declare(strict_types=1);

namespace Tests\PhpUnit;

use Iquety\Console\Command;
use Iquety\Console\PhpUnit\Constraints\CommandCountOptions;
use PHPUnit\Framework\ExpectationFailedException;

class CommandCountOptionsTest extends ConstraintTestCase
{
    /** @test */
    public function doAssertSuccess(): void
    {
        $constraint = new CommandCountOptions(3);

        $this->assertTrue(
            $constraint->evaluate($this->commandFactory(), '', true)
        );
    }

    /** @return array<string,array<int,mixed>> */
    public function failsProvider(): array
    {
        $list = [];

        $list['fail invalid amount zero'] = [ 0, $this->commandFactory()];
        $list['fail invalid amount one'] = [ 1, $this->commandFactory()];
        $list['fail invalid amount two'] = [ 2, $this->commandFactory()];
        $list['fail invalid amount four'] = [ 4, $this->commandFactory()];
        $list['success invalid command'] = [ 2, 'invalid command'];
        $list['fail invalid command'] = [ 0, 'invalid command'];

        return $list;
    }

    /**
     * @test
     * @dataProvider failsProvider
     */
    public function doAssertFail(int $value, Command|string $command): void
    {
        $constraint = new CommandCountOptions($value);

        try {
            $constraint->evaluate($command, '', false);
        } catch (ExpectationFailedException  $e) {
            $this->assertEquals(
                "Failed asserting that an command options count matches {$value}.\n",
                $this->exceptionToString($e)
            );
        }
    }
}
