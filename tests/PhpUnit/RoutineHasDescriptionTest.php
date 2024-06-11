<?php

declare(strict_types=1);

namespace Tests\PhpUnit;

use Iquety\Console\Routine;
use Iquety\Console\PhpUnit\Constraints\RoutineHasDescription;
use PHPUnit\Framework\ExpectationFailedException;

class RoutineHasDescriptionTest extends ConstraintTestCase
{
    /** @test */
    public function doAssertSuccess(): void
    {
        $constraint = new RoutineHasDescription('routine description');

        $this->assertTrue(
            $constraint->evaluate($this->routineFactory(), '', true)
        );
    }

    /** @return array<string,array<int,mixed>> */
    public function failsProvider(): array
    {
        $list = [];

        $list['fail invalid description'] = [ 'monono', $this->routineFactory()];
        $list['fail empty description'] = [ '', $this->routineFactory()];
        $list['success invalid routine'] = [ 'routine description', 'invalid routine'];
        $list['fail invalid routine'] = [ 'monomo', 'invalid routine'];

        return $list;
    }

    /**
     * @test
     * @dataProvider failsProvider
     */
    public function doAssertFail(string $value, Routine|string $routine): void
    {
        $constraint = new RoutineHasDescription($value);

        try {
            $constraint->evaluate($routine, '', false);
        } catch (ExpectationFailedException  $e) {
            $this->assertEquals(
                "Failed asserting that an routine has description '{$value}'.\n",
                $this->exceptionToString($e)
            );
        }
    }
}
