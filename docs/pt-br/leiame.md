# Freep Console

## Sinopse

Este repositório contém as funcionalidades necessárias para implementar um gerenciador de 
comandos para terminal em uma aplicação PHP de forma fácil.

Para informações detalhadas, consulte a documentação em [Inglês](../en/index.md) ou em [Português](indice.md). Veja também este 'readme' em [Inglês](../../readme.md).

## Modo de Usar

### 1. Crie um comando

Implemente um comando chamado "meu-comando", baseado na classe abstrata `Freep\Console\Command`:

```php
class MeuComando extends Command
{
    protected function initialize(): void
    {
        $this->setName("meu-comando");
        $this->addOption(
            new Option('-l', '--ler', 'Lê um arquivo texto', Option::REQUIRED)
        );
    }

    protected function handle(Arguments $arguments): void
    {
        $this->info("Olá");
    }
}
```

### 2. Crie um script

Crie um arquivo, chame-o por exemplo de "meuconsole", e adicione o seguinte conteúdo:

```php
#!/bin/php
<?php
include __DIR__ . "/vendor/autoload.php";

array_shift($argv);

$terminal = new Freep\Console\Terminal("/diretorio/contendo/comandos");
$terminal->run($argv);
```

### 3. Execute o script

```bash
$ ./meuconsole meu-comando -l
# exibe: Olá
```

```bash
$ ./meuconsole meu-comando --help
# exibe:
#
# Comando: meu-comando
# Executa o comando meu-comando
#
# Modo de usar:
# ./meuconsole meu-comando [opcoes]
#
# Opções:
# -a, --ajuda     Exibe a ajuda do comando
# -l, --ler       Lê um arquivo texto
```

```bash
$ ./meuconsole --ajuda
# exibe:
#
# Modo de usar:
# ./meuconsole comando [opcoes] [argumentos]
#
# Opções:
# -a, --ajuda     Exibe as informações de ajuda
#
# Comandos disponíveis:
# ajuda           Exibe as informações de ajuda
# meu-comando     Executa o comando meu-comando
```

## Características

-   Feito para o PHP 8.0 ou superior;
-   Codificado com boas práticas e máxima qualidade;
-   Bem documentado e amigável para IDEs;
-   Feito com TDD (Test Driven Development);
-   Implementado com testes de unidade usando PHPUnit;
-   Feito com :heart: &amp; :coffee:.

## Sumário

- [Modo de Usar](01-modo-de-usar.md)
- [Script de terminal](02-script-de-terminal.md)
- [Instanciando o Terminal](03-instanciando-o-terminal.md)
- [Criando Comandos](04-criando-comandos.md)
- [Implementando Opções](05-implementando-opcoes.md)
- [Usando os argumentos](06-usando-os-argumentos.md)
- [Evoluindo a biblioteca](07-evoluindo-a-biblioteca.md)

## Creditos

[Ricardo Pereira Dias](https://www.ricardopedias.com.br)