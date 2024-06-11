<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit;

use Iquety\Console\Routine;
use Iquety\Console\Option;
use Iquety\Console\PhpUnit\Constraints\RoutineCountOptions;
use Iquety\Console\PhpUnit\Constraints\RoutineHasName;
use Iquety\Console\PhpUnit\Constraints\RoutineHasDescription;
use Iquety\Console\PhpUnit\Constraints\RoutineHasHowToUse;
use Iquety\Console\PhpUnit\Constraints\RoutineHasOption;
use Iquety\Console\PhpUnit\Constraints\OptionHasDefaultValue;
use Iquety\Console\PhpUnit\Constraints\OptionHasDescription;
use Iquety\Console\PhpUnit\Constraints\OptionHasLongNotation;
use Iquety\Console\PhpUnit\Constraints\OptionHasShortNotation;
use Iquety\Console\PhpUnit\Constraints\OptionIsBoolean;
use Iquety\Console\PhpUnit\Constraints\OptionIsRequired;
use Iquety\Console\PhpUnit\Constraints\OptionIsValued;
use Iquety\Console\PhpUnit\Constraints\OptionIsNotBoolean;
use Iquety\Console\PhpUnit\Constraints\OptionIsNotRequired;
use Iquety\Console\PhpUnit\Constraints\OptionIsNotValued;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ConsoleTestCase extends TestCase
{
    public static function assertRoutineHasName(
        string $name,
        Routine $routine,
        string $message = ''
    ): void {
        $constraint = new RoutineHasName($name);
        self::assertThat($routine, $constraint, $message);
    }

    public static function assertRoutineHasDescription(
        string $name,
        Routine $routine,
        string $message = ''
    ): void {
        $constraint = new RoutineHasDescription($name);
        self::assertThat($routine, $constraint, $message);
    }

    public static function assertRoutineHasHowToUse(
        string $name,
        Routine $routine,
        string $message = ''
    ): void {
        $constraint = new RoutineHasHowToUse($name);
        self::assertThat($routine, $constraint, $message);
    }

    public static function assertRoutineHasOption(
        string $notation,
        Routine $routine,
        string $message = ''
    ): void {
        $constraint = new RoutineHasOption($notation);
        self::assertThat($routine, $constraint, $message);
    }

    public static function assertCountRoutineOptions(
        int $amount,
        Routine $routine,
        string $message = ''
    ): void {
        $constraint = new RoutineCountOptions($amount);
        self::assertThat($routine, $constraint, $message);
    }

    public static function assertOptionHasShortNotation(
        string $notation,
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionHasShortNotation($notation);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionHasLongNotation(
        string $notation,
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionHasLongNotation($notation);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionHasDescription(
        string $description,
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionHasDescription($description);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionHasDefaultValue(
        string $value,
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionHasDefaultValue($value);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsBoolean(
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionIsBoolean();
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsRequired(
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionIsRequired();
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsValued(
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionIsValued();
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsNotBoolean(
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionIsNotBoolean();
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsNotRequired(
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionIsNotRequired();
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsNotValued(
        Option $option,
        string $message = ''
    ): void {
        $constraint = new OptionIsNotValued();
        self::assertThat($option, $constraint, $message);
    }
}
