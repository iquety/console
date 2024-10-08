# Instanciando o terminal

[◂ Script de terminal](02-script-de-terminal.md) | [Sumário da Documentação](indice.md) | [Criando Rotinas ▸](04-criando-rotinas.md)
-- | -- | --

## 1. Implementação

A interpretação dos argumentos digitados pelo usuário acontece através da instância
da classe `Iquety\Console\Terminal`, que pode ser configurada da seguinte maneira:

```php
$terminal = new Terminal(__DIR__ . "/src");
$terminal->setHowToUse("./example routine [options] [arguments]");
$terminal->loadRoutinesFrom(__DIR__ . "/tests/FakeApp/ContextOne/src/Routines");
$terminal->loadRoutinesFrom(__DIR__ . "/tests/FakeApp/ContextTwo");

$terminal->run($argv);
```

## 2. Métodos disponíveis

### 2.1. O diretório de trabalho

```php
$terminal = new Terminal(__DIR__ . "/src");
```

A instância de `Iquety\Console\Terminal` deve ser criada, especificando um
**"diretório de trabalho"**. Este diretório, efetivamente, não tem causará
nenhum efeito colateral.

É apenas uma forma de dizer, a todos as rotinas existentes, qual é
o *"diretório principal"* do projeto atual.

Geralmente, o **"diretório de trabalho"** será o diretório raiz da aplicação que
usará a biblioteca para interpretar suas rotinas. Dessa forma, as rotinas poderão
saber onde se encontra a estrutura do projeto.

### 2.2. O modo de usar

```php
$terminal->setHowToUse("./example routine [options] [arguments]");
```

Especifica a mensagem de ajuda sobre o formato da rotina. Note que leva em
consideração o nome do script atual, ou seja, `example`.

### 2.3. Diretório de rotinas

```php
$terminal->loadRoutinesFrom(__DIR__ . "/tests/FakeApp/ContextOne/src/Routines");
$terminal->loadRoutinesFrom(__DIR__ . "/tests/FakeApp/ContextTwo");
```

Inúmeros diretórios contendo rotinas poderão ser especificados. Cada um será
varrido pela biblioteca a fim de identificar as rotinas disponíveis.

Quando o usuario digitar `./example --help`, as informações de ajuda de todos as
rotinas será utilizada para exibir uma tela de ajuda abrangente no terminal do usuário.

### 2.4. Interpretar a entrada do usuário

```php
$terminal->run($argv);
```

Os argumentos digitados pelo usuário no terminal do sistema operacional são interpretados
aqui, usando a variável reservada do PHP chamada "$argv". Ela contem  lista de palavras
digitadas no terminal e está presente somente quando um script PHP for executado em CLI,
ou seja, no terminal.

Mais informações da documentação do PHP em [Reserved Variables](https://www.php.net/manual/pt_BR/reserved.variables.argv.php)

### 2.5. Informações sobre a execução

É possível obter informações sobre a execução de uma rotina:

```php
$terminal->run($argv);

// devolve o nome da rotina executada
$rotinaExecutada = $terminal->executedRoutine();

// devolve o código da execução (0 = Sucesso, 126 = Erro, 127 = script inexistente)
$status = $terminal->executedStatus();
```

[◂ Script de terminal](02-script-de-terminal.md) | [Sumário da Documentação](indice.md) | [Criando Rotinas ▸](04-criando-rotinas.md)
-- | -- | --
