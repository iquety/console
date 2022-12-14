<?php

declare(strict_types=1);

namespace Tests\PhpUnit;

use Iquety\Console\Command;
use Iquety\Console\PhpUnit\Constraints\CommandHasDescription;
use PHPUnit\Framework\ExpectationFailedException;

class CommandHasDescriptionTest extends ConstraintTestCase
{
    /** @test */
    public function doAssertSuccess(): void
    {
        $constraint = new CommandHasDescription('command description');

        $this->assertTrue(
            $constraint->evaluate($this->commandFactory(), '', true)
        );
    }

    /** @return array<string,array<int,mixed>> */
    public function failsProvider(): array
    {
        $list = [];

        $list['fail invalid description'] = [ 'monono', $this->commandFactory()];
        $list['fail empty description'] = [ '', $this->commandFactory()];
        $list['success invalid command'] = [ 'command description', 'invalid command'];
        $list['fail invalid command'] = [ 'monomo', 'invalid command'];

        return $list;
    }

    /**
     * @test
     * @dataProvider failsProvider
     */
    public function doAssertFail(string $value, Command|string $command): void
    {
        $constraint = new CommandHasDescription($value);

        try {
            $constraint->evaluate($command, '', false);
        } catch (ExpectationFailedException  $e) {
            $this->assertEquals(
                "Failed asserting that an command has description '{$value}'.\n",
                $this->exceptionToString($e)
            );
        }
    }
}
