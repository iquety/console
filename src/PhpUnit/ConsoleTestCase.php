<?php

declare(strict_types=1);

namespace Iquety\Console\PhpUnit;

use Iquety\Console\Command;
use Iquety\Console\Option;
use Iquety\Console\PhpUnit\Constraints\CommandCountOptions;
use Iquety\Console\PhpUnit\Constraints\CommandHasName;
use Iquety\Console\PhpUnit\Constraints\CommandHasDescription;
use Iquety\Console\PhpUnit\Constraints\CommandHasHowToUse;
use Iquety\Console\PhpUnit\Constraints\CommandHasOption;
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
    public static function assertCommandHasName(
        string $name,
        Command $command,
        string $message = ''
    ): void {
        $constraint = new CommandHasName($name);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertCommandHasDescription(
        string $name,
        Command $command,
        string $message = ''
    ): void {
        $constraint = new CommandHasDescription($name);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertCommandHasHowToUse(
        string $name,
        Command $command,
        string $message = ''
    ): void {
        $constraint = new CommandHasHowToUse($name);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertCommandHasOption(
        string $notation,
        Command $command,
        string $message = ''
    ): void {
        $constraint = new CommandHasOption($notation);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertCountCommandOptions(
        int $amount,
        Command $command,
        string $message = ''
    ): void {
        $constraint = new CommandCountOptions($amount);
        self::assertThat($command, $constraint, $message);
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
