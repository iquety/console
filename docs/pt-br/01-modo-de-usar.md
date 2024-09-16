# Modo de Usar

[◂ Sumário da Documentação](indice.md) | [Script de terminal ▸](02-script-de-terminal.md)
-- | --

## 1. Instalação

### Modo Padrão

Para instalar o pacote do composer:

```bash
composer require iquety/console
```

### Referência cruzada

O pacote `iquety/docmap` possui uma referência cruzada com `iquety/console`. Por isso, se for necessário usar ambos os pacotes no mesmo projeto, é preciso deixar o `composer` gerenciá-los automaticamente,
deixando a configuracã́o da seguinte forma:

```json
"require": {
    ...
    "iquety/console": "*",
    ...
},
"require-dev": {
    ...
    "iquety/docmap": "*",
    ...
},
```

### Cross-reference

The `iquety/docmap` package has a cross-reference with `iquety/console`. Therefore, if you need to use both packages in the same project, you must let `composer` manage them automatically, leaving the configuration as follows:

```json
"require": {
    ...
    "iquety/console": "*",
    ...
},
"require-dev": {
    ...
    "iquety/docmap": "*",
    ...
},
```

## 2. Implementar comandos

A primeira coisa a fazer é criar as rotinas necessárias e alocá-las em algum diretório.
Uma rotina deve ser implementada com base na classe abstrata `Iquety\Console\Routine`,
conforme o exemplo abaixo:.

```php
class DizerOla extends Routine
{
    /**
     * Pelo menos o método "setName" deverá ser invocado para determinar a palavra 
     */
    protected function initialize(): void
    {
        $this->setName("dizer-ola");
        $this->setDescription("Exibe a mensagem 'olá' no terminal");
        $this->setHowToUse("./example dizer-ola [opcoes]");

        // Uma opção obrigatória e valorada.
        // Quando especificada no terminal, deverá vir acompanhada de um valor
        $this->addOption(
            new Option(
                '-l',
                '--ler-arquivo',
                'Lê a mensagem a partir de um arquivo texto',
                Option::REQUIRED | Option::VALUED
            )
        );

        // Uma opção não-obrigatória
        $this->addOption(
            new Option(
                '-d',
                '--destruir',
                'Apaga o arquivo texto após usá-lo',
                Option::OPTIONAL
            )
        );
    }

    /**
     * É neste método que as regras da rotina deverá ser implementada.
     */ 
    protected function handle(Arguments $arguments): void
    {
        $message = "Olá";

        if ($arguments->getOption('-l') !== '1') {
            $this->line("Lendo o arquivo texto contendo a mensagem de olá");
            // ... rotina para ler o arquivo texto
            $message = "";
        }

        if ($message === "") {
            $this->error("Não foi possível ler o arquivo texto");
        }

        if ($arguments->getOption('-d') === '1') {
            $this->warning("Apagando o arquivo texto usado");
            // ... rotina para apagar o arquivo texto
        }

        $this->info($message);
    }
}
```

Mais informações em [Criando Rotinas](04-criando-rotinas.md).

## 3. Criando o terminal

Com as rotinas implementadas no diretório desejado, é preciso criar uma instância de
`Iquety\Console\Terminal` e dizer para ela quais são os diretórios contendo as rotinas
implementados.

Por fim, basta mandar o Terminal executar as rotinas através do método `Terminal->executar()`:

```php
// Cria uma instância do Terminal. 
$terminal = new Terminal("raiz/da/super/aplicacao");

// Uma dica sobre como o terminal pode ser utilizado
$terminal->setHowToUse("./superapp rotina [opcoes] [argumentos]");

// Adiciona dois diretórios contendo rotinas
$terminal->loadRoutinesFrom(__DIR__ . "/rotinas");
$terminal->loadRoutinesFrom(__DIR__ . "/mais-rotinas");

// Executa o comando a partir de uma lista de argumentos
$terminal->run([ "dizer-ola", "-l", "mensagem.txt", "-d" ]);

```

Mais informações em [Instanciando o Terminal](03-instanciando-o-terminal.md).

[◂ Sumário da Documentação](indice.md) | [Script de terminal ▸](02-script-de-terminal.md)
-- | --
