# Iquety Console

![PHP Version](https://img.shields.io/badge/php-%5E8.4-blue)
![License](https://img.shields.io/badge/license-MIT-blue)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/22ee6215a7984d7096b833b38e6da26e)](https://www.codacy.com/gh/iquety/console/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=iquety/console&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://app.codacy.com/project/badge/Coverage/22ee6215a7984d7096b833b38e6da26e)](https://www.codacy.com/gh/iquety/console/dashboard?utm_source=github.com&utm_medium=referral&utm_content=iquety/console&utm_campaign=Badge_Coverage)

[English](readme.md) | [Português](./docs/pt-br/leiame.md)
-- | --

## Synopsis

This repository contains the necessary functionality to easily implement a terminal routine manager in a PHP application.

```bash
composer require iquety/console
```

For detailed information, see [Documentation Summary](docs/en/index.md).

## How to use

### 1. Create a routine

Implement a routine called "my-routine", based on the abstract class `Iquety\Console\Routine`:

```php
class MyRoutine extends Routine
{
    protected function initialize(): void
    {
        $this->setName("my-routine");
        $this->addOption(
            new Option('-r', '--read', 'Read a text file', Option::REQUIRED)
        );
    }

    protected function handle(Arguments $arguments): void
    {
        $this->info("Hello");
    }
}
```

### 2. Create a script

Create a file, call it for example "myconsole", and add the following content:

```php
#!/bin/php
<?php
include __DIR__ . "/vendor/autoload.php";

array_shift($argv);

$terminal = new Iquety\Console\Terminal("/root/of/super/application");
$terminal->loadRoutinesFrom("/directory/of/routines");
$terminal->run($argv);
```

### 3. Run the script

```bash
./myconsole my-routine -r
# will display: Hello
```

```bash
./myconsole my-routine --help
# will display:
#
# Routine: my-routine
# Run the 'my-routine' routine
# 
# How to use:
# ./myconsole my-routine [options]
# 
# Options:
# -h, --help   Display routine help
# -r, --read   Read a text file
```

```bash
./myconsole --help
# will display:
#
# How to use:
# ./myconsole routine [options] [arguments]
# 
# Options:
# -h, --help   Display routine help
#
# Available routines:
# help           Display routine help
# my-routine     Run the 'my-routine' routine
```

## Characteristics

- Made for PHP 8.3 or higher;
- Codified with best practices and maximum quality;
- Well documented and IDE friendly;
- Made with TDD (Test Driven Development);
- Implemented with unit tests using PHPUnit;
- Made with :heart: &amp; :coffee:.
## Credits

[Ricardo Pereira Dias](https://www.ricardopedias.com.br)
