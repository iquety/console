# How to use

[◂ Documentation Summary](index.md) | [Terminal script ▸](02-terminal-script.md)
-- | --

## 1. Implement routines

The first thing to do is create the necessary routines and place them in some
directory. A routine must be implemented based on the abstract class
`Iquety\Console\Routine`, as shown in the example below:

```php
class SayHello extends Routine
{
    /**
     * At least the "setName" method must be invoked to determine the word
     */
    protected function initialize(): void
    {
        $this->setName("say-hello");
        $this->setDescription("Display 'hello' message in terminal");
        $this->setHowToUse("./example say-hello [options]");

        // A mandatory and valued option.
        // When specified in the terminal, it must be accompanied by a value
        $this->addOption(
            new Option(
                '-r',
                '--read-file',
                'Read the message from a text file',
                Option::REQUIRED | Option::VALUED
            )
        );

        // A non-mandatory option
        $this->addOption(
            new Option(
                '-d',
                '--delete',
                'Delete the text file after using it',
                Option::OPTIONAL
            )
        );
    }

    /**
     * It is in this method that the rules of the routine must be implemented.
     */ 
    protected function handle(Arguments $arguments): void
    {
        $message = "Hello";

        if ($arguments->getOption('-r') !== '1') {
            $this->line("Reading the text file containing the hello message");
            // ... routine to read the text file
            $message = "";
        }

        if ($message === "") {
            $this->error("Could not read text file");
        }

        if ($arguments->getOption('-d') === '1') {
            $this->warning("Deleting the used text file");
            // ... routine to delete the text file
        }

        $this->info($message);
    }
}
```

More information at [Creating Routines](04-creating-routines.md).

## 2. Criando o terminal

With the routines implemented in the desired directory, it is necessary to create an instance of `Iquety\Console\Terminal` and tell it which directories contain the implemented routines.

Finally, just tell the Terminal to execute the routines through the `Terminal->run()` method:

```php
// Creates a Terminal instance.
$terminal = new Terminal("root/of/super/application");

// A tip on how the terminal can be used
$terminal->setHowToUse("./example routine [options] [arguments]");

// Add two directories containing routines
$terminal->loadRoutinesFrom(__DIR__ . "/routines");
$terminal->loadRoutinesFrom(__DIR__ . "/more-routines");

// Execute routine from a list of arguments
$terminal->run([ "say-hello", "-l", "message.txt", "-d" ]);

```

More information at [Instantiating the Terminal](03-instantiating-the-terminal.md).

[◂ Documentation Summary](index.md) | [Terminal script ▸](02-terminal-script.md)
-- | --
