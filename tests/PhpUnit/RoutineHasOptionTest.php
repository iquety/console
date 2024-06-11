<?php

declare(strict_types=1);

namespace Tests\PhpUnit;

use Iquety\Console\Routine;
use Iquety\Console\PhpUnit\Constraints\RoutineHasOption;
use PHPUnit\Framework\ExpectationFailedException;

class RoutineHasOptionTest extends ConstraintTestCase
{
    /** @return array<string,array<int,mixed>> */
    public function successProvider(): array
    {
        $list = [];

        $list['-a'] = [ '-a' ];
        $list['--aaa'] = [ '--aaa' ];
        $list['-b'] = [ '-b' ];
        $list['--bbb'] = [ '--bbb' ];

        return $list;
    }

    /**
     * @test
     * @dataProvider successProvider
     */
    public function doAssertSuccess(string $notation): void
    {
        $constraint = new RoutineHasOption($notation);

        $this->assertTrue(
            $constraint->evaluate($this->routineFactory(), '', true)
        );
    }

    /** @return array<string,array<int,mixed>> */
    public function failsProvider(): array
    {
        $list = [];

        $list['fail invalid option'] = [ '-c', $this->routineFactory()];
        $list['fail empty option'] = [ '', $this->routineFactory()];
        $list['success invalid routine'] = [ '-a', 'invalid routine'];
        $list['fail empty option invalid routine'] = [ '', 'invalid routine'];

        return $list;
    }

    /**
     * @test
     * @dataProvider failsProvider
     */
    public function doAssertFail(string $value, Routine|string $routine): void
    {
        $constraint = new RoutineHasOption($value);

        try {
            $constraint->evaluate($routine, '', false);
        } catch (ExpectationFailedException  $e) {
            $this->assertEquals(
                "Failed asserting that an routine has option '{$value}'.\n",
                $this->exceptionToString($e)
            );
        }
    }
}
