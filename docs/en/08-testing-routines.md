# Testing Routines

[◂ Message library](07-message-library.md) | [Documentation Summary](index.md) | [Evolving the library ▸](99-improving-the-library.md)
-- | -- | --

## 1. Using special assertions for PHPUnit

The library includes several features to be used in unit tests with PHPUnit. Just extend the `Iquety\Console\Tests\ConsoleTestCase` class instead of `PHPUnit\Framework\TestCase`.

## 2. Available assertions

The following additional assertions will be available for use:

- assertRoutineHasName
- assertRoutineHasDescription
- assertRoutineHasHowToUse
- assertRoutineHasOption
- assertCountRoutineOptions
- assertOptionHasShortNotation
- assertOptionHasLongNotation
- assertOptionHasDescription
- assertOptionHasDefaultValue
- assertOptionIsBoolean
- assertOptionIsRequired
- assertOptionIsValued
- assertOptionIsNotBoolean
- assertOptionIsNotRequired
- assertOptionIsNotValued

[◂ Message library](07-message-library.md) | [Documentation Summary](index.md) | [Evolving the library ▸](99-improving-the-library.md)
-- | -- | --
