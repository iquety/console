# Instantiating the Terminal

--page-nav--

## 1. Implementation

The interpretation of the arguments entered by the user happens through the
instance of the `Iquety\Console\Terminal` class, which can be configured as follows:

```php
$terminal = new Terminal(__DIR__ . "/src");
$terminal->setHowToUse("./example routine [options] [arguments]");
$terminal->loadRoutinesFrom(__DIR__ . "/tests/FakeApp/ContextOne/src/Routines");
$terminal->loadRoutinesFrom(__DIR__ . "/tests/FakeApp/ContextTwo");

$terminal->run($argv);
```

## 2. Available methods

### 2.1. The working directory

```php
$terminal = new Terminal(__DIR__ . "/src");
```

The instance of `Iquety\Console\Terminal` must be created, specifying a **"working directory"**.
This directory will effectively not cause any side effects.

It's just a way to make available, for all existing routines, what is the *"main
directory"* of the current project.

Generally, the **"working directory"** will be the root directory of the application
that will use the library to interpret its routines. That way, the routines will
be able to know where the project structure is.

### 2.2. How to use

```php
$terminal->setHowToUse("./example routine [options] [arguments]");
```

Specifies the help message about the routine format. Note that it takes into
account the name of the current script, ie `example`.

### 2.3. Routine directory

```php
$terminal->loadRoutinesFrom(__DIR__ . "/tests/FakeApp/ContextOne/src/Routines");
$terminal->loadRoutinesFrom(__DIR__ . "/tests/FakeApp/ContextTwo");
```

Numerous directories containing routines can be specified. Each will be scanned
through the library to identify available routines.

When the user types `./example --help`, the help information for all routines
will be used to display a comprehensive help screen in the user's terminal.

### 2.4. Interpret user input

```php
$terminal->run($argv);
```

Arguments typed by the user in the operating system's terminal are interpreted
here, using the PHP reserved variable called "$argv". It contains a list of words
typed in the terminal and is only present when a PHP script is executed in CLI,
that is, in the terminal.

More information from the PHP documentation at [Reserved Variables](https://www.php.net/manual/pt_BR/reserved.variables.argv.php)

### 2.5. Execution information

You can get information about the execution of a routine:

```php
$terminal->run($argv);

// returns the name of the executed routine
$executedRoutine = $terminal->executedRoutine();

// returns the execution code (0 = Success, 126 = Error, 127 = non-existent script)
$status = $terminal->executedStatus();
```

--page-nav--
