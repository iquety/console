<?php

declare(strict_types=1);

namespace Tests\PhpUnit;

use Iquety\Console\Routine;
use Iquety\Console\PhpUnit\Constraints\RoutineCountOptions;
use PHPUnit\Framework\ExpectationFailedException;

class RoutineCountOptionsTest extends ConstraintTestCase
{
    /** @test */
    public function doAssertSuccess(): void
    {
        $constraint = new RoutineCountOptions(3);

        $this->assertTrue(
            $constraint->evaluate($this->routineFactory(), '', true)
        );
    }

    /** @return array<string,array<int,mixed>> */
    public function failsProvider(): array
    {
        $list = [];

        $list['fail invalid amount zero'] = [ 0, $this->routineFactory()];
        $list['fail invalid amount one'] = [ 1, $this->routineFactory()];
        $list['fail invalid amount two'] = [ 2, $this->routineFactory()];
        $list['fail invalid amount four'] = [ 4, $this->routineFactory()];
        $list['success invalid routine'] = [ 2, 'invalid routine'];
        $list['fail invalid routine'] = [ 0, 'invalid routine'];

        return $list;
    }

    /**
     * @test
     * @dataProvider failsProvider
     */
    public function doAssertFail(int $value, Routine|string $routine): void
    {
        $constraint = new RoutineCountOptions($value);

        try {
            $constraint->evaluate($routine, '', false);
        } catch (ExpectationFailedException  $e) {
            $this->assertEquals(
                "Failed asserting that an routine options count matches {$value}.\n",
                $this->exceptionToString($e)
            );
        }
    }
}
