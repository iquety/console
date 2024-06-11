<?php

declare(strict_types=1);

namespace Tests\PhpUnit;

use Iquety\Console\Routine;
use Iquety\Console\PhpUnit\Constraints\RoutineHasName;
use PHPUnit\Framework\ExpectationFailedException;

class RoutineHasNameTest extends ConstraintTestCase
{
    /** @test */
    public function doAssertSuccess(): void
    {
        $constraint = new RoutineHasName('routine-name');

        $this->assertTrue(
            $constraint->evaluate($this->routineFactory(), '', true)
        );
    }

    /** @return array<string,array<int,mixed>> */
    public function failsProvider(): array
    {
        $list = [];

        $list['fail invalid name'] = [ 'monono', $this->routineFactory()];
        $list['fail empty name'] = [ '', $this->routineFactory()];
        $list['success invalid routine'] = [ 'routine-name', 'invalid routine'];
        $list['fail invalid routine'] = [ 'monomo', 'invalid routine'];

        return $list;
    }

    /**
     * @test
     * @dataProvider failsProvider
     */
    public function doAssertFail(string $value, Routine|string $routine): void
    {
        $constraint = new RoutineHasName($value);

        try {
            $constraint->evaluate($routine, '', false);
        } catch (ExpectationFailedException  $e) {
            $this->assertEquals(
                "Failed asserting that an routine has name '{$value}'.\n",
                $this->exceptionToString($e)
            );
        }
    }
}
