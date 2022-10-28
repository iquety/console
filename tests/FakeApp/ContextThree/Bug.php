<?php
// phpcs:ignoreFile

declare(strict_types=1);

// Sem namespace é impossível instanciar o script

use Iquety\Console\Arguments;
use Iquety\Console\Command;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class Bug extends Command
{
    protected function initialize(): void
    {
        $this->setName("bug");
        $this->setDescription("Run the buggy command");
    }

    protected function handle(Arguments $arguments): void
    {
        // ...
    }
}
