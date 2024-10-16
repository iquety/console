<?php

declare(strict_types=1);

namespace Tests\PhpUnit;

use Iquety\Console\Option;
use Iquety\Console\PhpUnit\Constraints\OptionIsValued;
use PHPUnit\Framework\ExpectationFailedException;

class OptionIsValuedTest extends ConstraintTestCase
{
    /** @return array<string,array<int,mixed>> */
    public function successProvider(): array
    {
        $list = [];

        $list['valued'] = [ $this->optionFactory(Option::VALUED) ];
        $list['valued with default value'] = [ $this->optionFactory(Option::VALUED, 'has value') ];
        $list['required valued'] = [ $this->optionFactory(Option::REQUIRED | Option::VALUED) ];
        $list['required valued with default value'] = [
            $this->optionFactory(Option::REQUIRED | Option::VALUED, 'has value')
        ];

        return $list;
    }

    /**
     * @test
     * @dataProvider successProvider
     */
    public function doAssertSuccess(Option $option): void
    {
        $constraint = new OptionIsValued();

        $this->assertTrue(
            $constraint->evaluate($option, '', true)
        );
    }

    /** @return array<string,array<int,mixed>> */
    public function failsProvider(): array
    {
        $list = [];

        $list['optional'] = [ $this->optionFactory(Option::OPTIONAL)];
        $list['optional with default false'] = [ $this->optionFactory(Option::OPTIONAL, '0')];
        $list['optional with default true'] = [ $this->optionFactory(Option::OPTIONAL, '1')];
        $list['required'] = [ $this->optionFactory(Option::REQUIRED)];
        $list['required with default false'] = [ $this->optionFactory(Option::REQUIRED, '0')];
        $list['required with default true'] = [ $this->optionFactory(Option::REQUIRED, '1')];
        $list['invalid option'] = [ 'invalid option'];

        return $list;
    }

    /**
     * @test
     * @dataProvider failsProvider
     */
    public function doAssertFail(Option|string $option): void
    {
        $constraint = new OptionIsValued();

        try {
            $constraint->evaluate($option, '', false);
        } catch (ExpectationFailedException  $e) {
            $this->assertEquals(
                "Failed asserting that an option is valued.\n",
                $this->exceptionToString($e)
            );
        }
    }
}
