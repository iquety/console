<?php

declare(strict_types=1);

namespace Tests\PhpUnit;

use Iquety\Console\Routine;
use Iquety\Console\PhpUnit\Constraints\RoutineHasHowToUse;
use PHPUnit\Framework\ExpectationFailedException;

class RoutineHasHowToUseTest extends ConstraintTestCase
{
    /** @test */
    public function doAssertSuccess(): void
    {
        $constraint = new RoutineHasHowToUse('how to use description');

        $this->assertTrue(
            $constraint->evaluate($this->routineFactory(), '', true)
        );
    }

    /** @return array<string,array<int,mixed>> */
    public function failsProvider(): array
    {
        $list = [];

        $list['fail invalid how to use'] = [ 'monono', $this->routineFactory()];
        $list['fail empty how to use'] = [ '', $this->routineFactory()];
        $list['success invalid routine'] = [ 'how to use description', 'invalid routine'];
        $list['fail invalid routine'] = [ 'monomo', 'invalid routine'];

        return $list;
    }

    /**
     * @test
     * @dataProvider failsProvider
     */
    public function doAssertFail(string $value, Routine|string $routine): void
    {
        $constraint = new RoutineHasHowToUse($value);

        try {
            $constraint->evaluate($routine, '', false);
        } catch (ExpectationFailedException  $e) {
            $this->assertEquals(
                "Failed asserting that an routine has how to use '{$value}'.\n",
                $this->exceptionToString($e)
            );
        }
    }
}
