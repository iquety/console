# Creating Routines

[◂ Instantiating the Terminal](03-instantiating-the-terminal.md) | [Documentation Summary](index.md) | [Implementing Options ▸](05-implementing-options.md)
-- | -- | --

## 1. About a routine

All routines must be implemented based on the abstract class `Iquety\Console\Routine`:

```php
abstract class Routine
{
    abstract protected function initialize(): void;

    abstract protected function handle(Arguments $arguments): void;
}
```

## 2. The initialize method

### 2.1. About

In the `"Routine->initialize()"` method, the routine settings must be implemented, such as name, help message, options, etc.

A minimal implementation must contain at least the `"Routine->setName()"` method, which provides the name of the routine.

```php
class MyRoutine extends Routine
{
    protected function initialize(): void
    {
        $this->setName("my-routine");

        // other routine settings
    }

    //...
}
```

### 2.2. Set the routine name

Specifies the name of the routine, that is, the word the user will type into the terminal to invoke it.

```php
$this->setName("my-routine");
```

### 2.3. Set routine description

Specifies a description of the purpose of the routine.
This message will be displayed in the help information

```php
$this->setDescription("Display 'hello' message in terminal");
```

### 2.4. Set how to use

Specifies a hint on how this routine can be used.
This message will be displayed in the help information

```php
$this->setHowToUse("./example say-hello [options]");
```

### 2.5. Add an option

Adds an option to the routine, which can be *required*, *optional* or *valued*.

More information about options in [Implementing options](05-implementing-options.md).

```php
$this->addOption(new Option(
    '-d',
    '--delete',
    'Delete the text file after using it',
    Option::OPTIONAL
));
```

## 3. Handle arguments

### 3.1. About

Likewise, the `"Routine->handle()"` method must be implemented in all routines. It is in this method that the routine routine should be implemented.

In this method, it is possible to interact with the user and obtain information about what he has provided as arguments when invoking the routine.

```php
class MyRoutine extends Routine
{
    // ...

    protected function handle(Arguments $arguments): void
    {
        // routine routine implementation

        $this->info('Routine executed successfully');
    }

    //...
}
```

### 3.2.Get the current terminal

Gets the current terminal instance, allowing access to useful information.

```php
$instancia = $this->getTerminal();
```

### 3.3. Get the path of the current application

Gets the full path to the root of the application. You can specify a suffix, to easily compose a more complete path:

```php
echo $this->getAppPath();
// /home/ricardo/project

echo $this->getAppPath('console/php');
// /home/ricardo/project/console/php
```

### 3.4. Show a message

Messages are triggered directly by existing methods in the `Iquety\Console\Routine` abstract class.
Under the hood, the `Iquety\Console\Message` class is used for this job.
More information about its usefulness can be found in [Message library](08-message-library.md).

#### 3.4.1. Show an warning

Displays an orange highlighted text on the user terminal.

```php
echo $this->warning("Non-existent operation");
```

#### 3.4.2. Show an error

Displays red highlighted text in the user terminal.

```php
echo $this->error("An error has occurred");
```

#### 3.4.3. Show an information

Displays green highlighted text on the user terminal.

```php
echo $this->info("Operation performed");
```

#### 3.4.4. Show a simple text

Displays text without highlighting on the user's terminal.

```php
echo $this->line("Running routine");
```

## 4. Object Arguments

To identify the options provided by the user in the terminal, the `Iquety\Console\Arguments` object is used, which provides access to the specified options, values and arguments.

This object is available as an argument of the `"Routine->handle()"` method.

More information about arguments at [Using the arguments](06-using-the-arguments.md).

[◂ Instantiating the Terminal](03-instantiating-the-terminal.md) | [Documentation Summary](index.md) | [Implementing Options ▸](05-implementing-options.md)
-- | -- | --
