<?php

declare(strict_types=1);

namespace Iquety\Console;

use Iquety\Console\Routines\Help;
use Iquety\Security\Filesystem;
use Iquety\Security\Path;
use InvalidArgumentException;
use RuntimeException;
use Throwable;

class Terminal
{
    /**
     * Para mais informações sobre os status do SHELL
     * @see https://www.cyberciti.biz/faq/linux-bash-exit-status-set-exit-statusin-bash
     */
    public const STATUS_SUCCESS = 0;

    public const STATUS_ERROR = 126;

    public const STATUS_NOT_FOUND = 127;

    private string $appPath;

    /** @var array<string> */
    private array $directoryList = [];

    private string $executedRoutine = "no";

    private int $executedStatus = 0;

    private string $howToUse = "";

    public function __construct(string $appPath)
    {
        try {
            $realPath = (new Path($appPath))->getAbsolutePath();
        } catch (RuntimeException) {
            throw new InvalidArgumentException("The specified application directory does not exist");
        }

        $this->appPath = $realPath;

        $this->loadRoutinesFrom(__DIR__ . '/Routines');
    }

    public function factoryMessage(string $message): Message
    {
        return new Message($message);
    }

    private function filesystem(string $contextPath): Filesystem
    {
        return new Filesystem($contextPath);
    }

    public function setHowToUse(string $text): void
    {
        $this->howToUse = $text;
    }

    public function getHowToUse(): string
    {
        return $this->howToUse;
    }

    public function getAppPath(): string
    {
        return $this->appPath;
    }

    public function loadRoutinesFrom(string $routinesPath): self
    {
        try {
            $realPath = (new Path($routinesPath))->getAbsolutePath();
        } catch (RuntimeException) {
            throw new InvalidArgumentException("The directory specified for routines does not exist");
        }

        $this->directoryList[] = $realPath;

        return $this;
    }

    /**
     * @param array<int,string> $arguments
     */
    public function run(array $arguments): void
    {
        if (
            isset($arguments[0]) === false
            || in_array($arguments[0], ['--help', '-h']) === true
        ) {
            $arguments[0] = "help";
        }

        $routineName = array_shift($arguments);

        try {
            $this->runRoutine($routineName, $arguments);
        } catch (Throwable $e) {
            $this->factoryMessage($e->getFile() . " on line " . $e->getLine())->error();

            $this->factoryMessage("   " . $e->getMessage())->red();

            if ($this->executedStatus === self::STATUS_SUCCESS) {
                $this->executedStatus = self::STATUS_ERROR;
            }
        }
    }

    /** @return array<int,string> */
    public function getRoutineList(): array
    {
        $allRoutines = [];

        foreach ($this->directoryList as $path) {
            $fileList = array_map(
                fn($fileObject) => $fileObject->getPath(),
                $this->filesystem($path)->getDirectoryFiles('/')
            );

            $allRoutines = array_merge(
                $allRoutines,
                $fileList
            );
        }

        return $allRoutines;
    }

    /**
     * @param array<int,string> $arguments
     */
    public function runRoutine(string $name, array $arguments): void
    {
        $routineName = $this->normalizeRoutineName($name);

        $allRoutines = $this->getRoutineList();

        if ($routineName === "Help") {
            (new Help($this))->run($arguments);

            $this->executedRoutine = Help::class;
            $this->executedStatus = self::STATUS_SUCCESS;

            return;
        }

        foreach ($allRoutines as $routineFile) {
            $routineClassName = $this->parseClassName($routineFile);

            if (class_exists($routineClassName) === false) {
                $this->executedStatus = self::STATUS_ERROR;

                throw new RuntimeException(
                    "The file '$routineFile' not contains a '$routineClassName' class"
                );
            }

            /** @var Routine $routineObject */
            $routineObject = (new $routineClassName($this));

            if ($routineName !== $this->normalizeRoutineName($routineObject->getName())) {
                continue;
            }

            $routineObject->run($arguments);

            $this->executedRoutine = $routineClassName;
            $this->executedStatus = self::STATUS_SUCCESS;

            return;
        }

        $this->factoryMessage("'{$name}' routine not found")->error();

        (new Help($this))->run($arguments);

        $this->executedStatus = self::STATUS_NOT_FOUND;
    }

    private function extractNamespace(string $oneFile): string
    {
        $pathInfo = new Path($oneFile);
        $contextPath = $pathInfo->getDirectory();
        $file = $pathInfo->getFile();

        $allLines = $this->filesystem($contextPath)->getFileRows($file);
        foreach ($allLines as $line) {
            $line = (string)$line;

            if (str_starts_with(trim($line), "namespace") === true) {
                $limit = strpos($line, ';');
                $limit = $limit === false ? null : $limit;

                $line = substr($line, 0, $limit);

                return trim(str_replace("namespace ", "", $line));
            }
        }

        throw new RuntimeException("Unable to extract namespace from file '{$oneFile}'");
    }

    private function extractClassName(string $routineFile): string
    {
        return str_replace('.php', '', array_slice(explode("/", $routineFile), -1)[0]);
    }

    public function parseClassName(string $routineFile): string
    {
        return $this->extractNamespace($routineFile)
            . "\\" . $this->extractClassName($routineFile);
    }

    private function normalizeRoutineName(string $kebabCaseName): string
    {
        // make:user-controller -> [Make, User-controller]
        $kebabCase = array_map(
            fn($noh) => ucfirst($noh),
            explode(":", $kebabCaseName)
        );

        $nameWithoutAColon = implode("", $kebabCase); // MakeUser-controller

        // MakeUser-controller -> [MakeUser, Controller]
        $pascalCase = array_map(
            fn($noh) => ucfirst($noh),
            explode("-", $nameWithoutAColon)
        );

        return implode("", $pascalCase); // MakeUserController
    }

    public function executedRoutine(): string
    {
        return $this->executedRoutine;
    }

    public function executedStatus(): int
    {
        return $this->executedStatus;
    }
}
