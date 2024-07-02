# Criando Rotinas

--page-nav--

## 1. Sobre uma rotina

Todas as rotinas devem ser implementadas com base na classe abstrata `Iquety\Console\Routine`:

```php
abstract class Routine
{
    abstract protected function initialize(): void;

    abstract protected function handle(Arguments $arguments): void;
}
```

## 2. Método inicializar

### 2.1. Sobre

No método `"Routine->initialize()"` devem ser implementadas as configurações da
rotina, como o nome, a mensagem de ajuda, as opções, etc.

Uma implementação mínima deve conter ao menos o método `"Routine->setName()"`,
que fornece o nome da rotina.

```php
class MeuComando extends Routine
{
    protected function initialize(): void
    {
        $this->setName("minha-rotina");

        // outras configurações da rotina
    }

    //...
}
```

### 2.2. Setar o nome da rotina

Especifica o nome da rotina, ou seja, a palavra que o usuário digitará no terminal
para invocá-la.

```php
$this->setName("minha-rotina");
```

### 2.3. Setar a descrição da rotina

Especifica uma descrição sobre o objetivo da rotina. Esta mensagem será exibida
nas informações de ajuda

```php
$this->setDescription("Exibe a mensagem 'olá' no terminal");
```

### 2.4. Setar o modo de usar

Especifica uma dica sobre como esta rotina pode ser utilizada. Esta mensagem
será exibida nas informações de ajuda.

```php
$this->setHowToUse("./example dizer-ola [opcoes]");
```

### 2.5. Adicionar uma opção

Adiciona uma opção à rotina, podendo ser *obrigatória*, *opcional* ou *valorada*.

Mais informações sobre opções em [Implementando Opções](05-implementando-opcoes.md).

```php
$this->addOption(new Option(
    '-d',
    '--destruir',
    'Apaga o arquivo texto após usá-lo',
    Option::OPTIONAL
));
```

## 3. Manipular argumentos

### 3.1. Sobre

Da mesma forma, o método `"Routine->handle()"` deve ser implementado em todas as
rotinas. É neste método que as regras da rotina deverá ser implementada.

Neste método, é possível interagir com o usuário e obter informações sobre o que
ele forneceu como argumentos ao invocar a rotina.

```php
class MinhaRotina extends Routine
{
    // ...

    protected function handle(Arguments $arguments): void
    {
        // implementação da rotina do rotina

        $this->info('Comando executado com sucesso');
    }

    //...
}
```

### 3.2. Obter o terminal atual

Obtém a intância do terminal atual, permitindo acessar informações úteis.

```php
$instancia = $this->getTerminal();
```

### 3.3. Obter o caminho da aplicação atual

Obtém o caminho completo até a raiz da aplicação. Pode-se especificar um sufixo,
para compor facilmente um caminho mais completo:

```php
echo $this->getAppPath();
// /home/ricardo/projeto

echo $this->getAppPath('console/php');
// /home/ricardo/projeto/console/php
```

### 3.4. Emitir uma mensagem

As mensagens são disparadas diretamente por métodos já existentes na classe abstrata `Iquety\Console\Routine`.
Por baixo dos panos, a classe `Iquety\Console\Message` é usada para esse trabalho.
Mais informações sobre sua utilidade pode ser consultada em [Biblioteca de mensagens](08-biblioteca-de-mensagens.md).

### 3.4.1. Emitir um alerta

Exibe um texto detacado em laranja no terminal do usuário.

```php
echo $this->warning("Operação inexistente");
```

### 3.4.2. Emitir um erro

Exibe um texto detacado em vermelho no terminal do usuário.

```php
echo $this->error("Ocorreu um erro");
```

### 3.4.3. Emitir uma informação

Exibe um texto detacado em verde no terminal do usuário.

```php
echo $this->info("Operação executada");
```

### 3.4.4. Emitir um texto simples

Exibe um texto sem destaque no terminal do usuário.

```php
echo $this->line("Executando rotina");
```

## 4. Objeto Argumentos

Para identificar as opções fornecidas pelo usuário no terminal, usa-se o objeto
`Iquety\Console\Arguments`, que fornece acesso às opções, valores e argumentos
especificados.

Este objeto é disponibilizado como argumento do método `"Routine->handle()"`.

Mais informações sobre argumentos em [Usando os Argumentos](06-usando-os-argumentos.md).

--page-nav--
