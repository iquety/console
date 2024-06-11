# Testando comandos

[◂ Evoluindo a biblioteca](07-biblioteca-de-mensagens.md) | [Sumário da Documentação](indice.md) | [Evoluindo a biblioteca ▸](99-evoluindo-a-biblioteca.md)
-- | -- | --

## 1. Usando asserções especiais para PHPUnit

A biblioteca inclui diversas funcionalidades para serem usadas em testes de unidade com o PHPUnit. Basta estender a classe `Iquety\Console\Tests\ConsoleTestCase` ao invés da `PHPUnit\Framework\TestCase`.

## 2. Asserções disponíveis

As seguintes asserções adicionais estarão disponíveis para uso:

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

[◂ Evoluindo a biblioteca](07-biblioteca-de-mensagens.md) | [Sumário da Documentação](indice.md) | [Evoluindo a biblioteca ▸](99-evoluindo-a-biblioteca.md)
-- | -- | --
