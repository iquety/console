<?php

declare(strict_types=1);

namespace Iquety\Console\Routines;

use Iquety\Console\Arguments;
use Iquety\Console\Routine;

class Help extends Routine
{
    protected function initialize(): void
    {
        $this->setName("help");
        $this->setDescription("Display help information");
    }

    protected function handle(Arguments $arguments): void
    {
        if ($this->getTerminal()->getHowToUse() !== "") {
            $this->printSection("How to use:");
            $this->line("  " . $this->getTerminal()->getHowToUse());
        }

        $this->printSection("Options:");

        $this->printOption("-h", "--help", $this->getDescription());

        $this->printSection("Available routines:");

        $routineList = $this->getRoutineList();

        foreach ($routineList as $routine) {
            $this->printRoutine($routine->getName(), $routine->getDescription());
        }
    }

    /** @return array<int,Routine> */
    private function getRoutineList(): array
    {
        $list = [];

        $routineList = $this->getTerminal()->getRoutineList();

        foreach ($routineList as $routineFile) {
            $routineClassName = $this->getTerminal()->parseClassName($routineFile);

            $routineObject = (new $routineClassName($this->getTerminal()));
            $list[] = $routineObject;
        }

        return $list;
    }

    private function printRoutine(string $routine, string $description): void
    {
        $column = 20;
        $characters = mb_strlen($routine);
        $spacing = $characters < $column
            ? str_repeat(" ", $column - $characters)
            : " ";

        $this->getTerminal()->factoryMessage("$routine ")->yellow();
        $this->getTerminal()->factoryMessage(" " . $spacing . $description)->outputLn();
    }
}
