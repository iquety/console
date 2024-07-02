# Message library

[◂ Using arguments](06-using-the-arguments.md) | [Documentation Summary](index.md) | [Testing Routines ▸](08-testing-routines.md)
-- | -- | --

In addition to exclusive features for creating and executing routines, iquety/console
contains a dedicated class for displaying messages in the terminal.

It is not necessary to use it directly, as the abstract class `Iquety\Console\Routine`
offers methods to facilitate its use, as explained in [Creating Routines](04-creating-routines.md).

Below are the methods available in the `Iquety\Console\Message` class:

```php
$message = new Message('thundercats');

// blue message
$message->blue();
$message->blueLn(); // with line break

// green message
$message->green();
$message->greenLn(); // with line break

// red message
$message->red();
$message->redLn(); // with line break

// yellow message
$message->yellow();
$message->yellowLn(); // with line break

// error message (with icon ✗)
$message->error();
$message->errorLn(); // with line break

// information message (with icon ➜)
$message->info();
$message->infoLn(); // with line break

// success message (with icon ✔)
$message->success();
$message->successLn(); // with line break

// warning message (with icon ✱)
$message->warning();
$message->warningLn(); // with line break

// common message
$message->output();
$message->outputLn(); // with line break
```

[◂ Using arguments](06-using-the-arguments.md) | [Documentation Summary](index.md) | [Testing Routines ▸](08-testing-routines.md)
-- | -- | --
