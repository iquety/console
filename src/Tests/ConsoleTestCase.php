<?php

declare(strict_types=1);

namespace Freep\Console\Tests;

use Freep\Console\Command;
use Freep\Console\Option;
use Freep\Console\Tests\Constraints\CommandCountOptions;
use Freep\Console\Tests\Constraints\CommandHasName;
use Freep\Console\Tests\Constraints\CommandHasDescription;
use Freep\Console\Tests\Constraints\CommandHasHowToUse;
use Freep\Console\Tests\Constraints\CommandHasOption;
use Freep\Console\Tests\Constraints\OptionHasDefaultValue;
use Freep\Console\Tests\Constraints\OptionHasDescription;
use Freep\Console\Tests\Constraints\OptionHasLongNotation;
use Freep\Console\Tests\Constraints\OptionHasShortNotation;
use Freep\Console\Tests\Constraints\OptionIsBoolean;
use Freep\Console\Tests\Constraints\OptionIsRequired;
use Freep\Console\Tests\Constraints\OptionIsValued;
use Freep\Console\Tests\Constraints\OptionIsNotBoolean;
use Freep\Console\Tests\Constraints\OptionIsNotRequired;
use Freep\Console\Tests\Constraints\OptionIsNotValued;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ConsoleTestCase extends TestCase
{
    public static function assertCommandHasName(
        string $name,
        Command $command,
        string $message = ''
    ) {
        $constraint = new CommandHasName($name);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertCommandHasDescription(
        string $name,
        Command $command,
        string $message = ''
    ) {
        $constraint = new CommandHasDescription($name);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertCommandHasHowToUse(
        string $name,
        Command $command,
        string $message = ''
    ) {
        $constraint = new CommandHasHowToUse($name);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertCommandHasOption(
        string $notation,
        Command $command,
        string $message = ''
    ) {
        $constraint = new CommandHasOption($notation);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertCountCommandOptions(
        int $amount,
        Command $command,
        string $message = ''
    ) {
        $constraint = new CommandCountOptions($amount);
        self::assertThat($command, $constraint, $message);
    }

    public static function assertOptionHasShortNotation(
        string $notation,
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionHasShortNotation($notation);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionHasLongNotation(
        string $notation,
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionHasLongNotation($notation);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionHasDescription(
        string $description,
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionHasDescription($description);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionHasDefaultValue(
        string $value,
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionHasDefaultValue($value);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsBoolean(
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionIsBoolean($option);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsRequired(
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionIsRequired($option);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsValued(
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionIsValued($option);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsNotBoolean(
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionIsNotBoolean($option);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsNotRequired(
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionIsNotRequired($option);
        self::assertThat($option, $constraint, $message);
    }

    public static function assertOptionIsNotValued(
        Option $option,
        string $message = ''
    ) {
        $constraint = new OptionIsNotValued($option);
        self::assertThat($option, $constraint, $message);
    }
}
