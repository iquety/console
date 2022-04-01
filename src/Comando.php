<?php

declare(strict_types=1);

namespace Freep\Console;

use InvalidArgumentException;

abstract class Comando
{
    private string $nome = 'sem-nome';

    private string $descricao = "Executar o comando 'sem-nome'";

    private Terminal $terminal;

    /** @var array<int,Opcap> */
    private array $opcoes = [];

    /**
     * O caminho principal é especificado aqui para que o comando executado possa
     * encontrar a localização da aplicação na qual ele está acoplado.
     * 
     * @param string $caminhoAplicacao Caminho principal, compartilhado com todos os comandos
     */
    public function __construct(Terminal $terminal)
    {
        $this->terminal = $terminal;
        
        $this->adicionarOpcao(
            new Opcao('-a', '--ajuda', "Exibe a ajuda do comando", Opcao::OPCIONAL)
        );

        $this->inicializar();
    }

    protected function setarNome(string $nomeComando): void
    {
        if (strpos($nomeComando, " ") !== false) {
            throw new InvalidArgumentException(
                "O nome de um comando deve ser no formato kebab-case. Ex: nome-do-comando"
            );
        }

        $this->nome = $nomeComando;
        $this->descricao = "Executar o comando '{$nomeComando}'";
    }

    protected function setarDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    protected function adicionarOpcao(Opcao $opcao): void
    {
        $this->opcoes[] = $opcao;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function descricao(): string
    {
        return $this->descricao;
    }

    /** @return array<int,Opcao> */
    public function opcoes(): array
    {
        return $this->opcoes;
    }

    abstract protected function inicializar(): void;

    abstract protected function manipular(Argumentos $argumentos): void;

    /** @param array<int,string> $argumentosComando */
    public function executar(array $argumentosComando): void
    {
        $interpretador = new Interpretador($this->opcoes());
        $argumentos = $interpretador->interpretarListaArgumentos($argumentosComando);

        if ($argumentos->opcao('-a') === '1') {
            $this->imprimirAjuda();
            return;
        }

        $this->manipular($argumentos);
    }

    private function imprimirAjuda(): void
    {
        $this->imprimirSecao("Comando: " . $this->nome());

        $this->linha(" " . $this->descricao());

        $this->imprimirSecao("Modo de usar:");

        $this->linha(sprintf(" ./freep %s [opcoes]", $this->nome()));

        $this->imprimirSecao("Opções:");

        foreach($this->opcoes() as $opcao) {
            $this->imprimirOpcao($opcao->notacaoCurta(), $opcao->notacaoLonga(), $opcao->descricao());
        }
    }

    private function imprimirSecao(string $descricao): void
    {
        $this->linha("\n\033[0;33m{$descricao} \033[0m");
    }

    private function imprimirOpcao(string $curta, string $longa, string $descricao): void
    {
        $argumento = "{$curta}, {$longa}";

        $coluna = 20;
        $caracteres = mb_strlen($argumento);
        $espacamento = $caracteres < $coluna
            ? str_repeat(" ", $coluna - $caracteres)
            : " ";

        $involucro = " \033[0;32m%s \033[0m %s";
        $this->linha(sprintf($involucro, $argumento, $espacamento . $descricao));
    }

    protected function obterTerminal(): Terminal
    {
        return $this->terminal;
    }

    protected function caminhoAplicacao(string $sufixo = ""): string
    {
        return $this->obterTerminal()->caminhoAplicacao() . "/" . trim($sufixo, "/");
    }

    protected function linha(string $texto): void
    {
        $this->imprimir($texto . "\n");
    }

    protected function erro(string $texto): void
    {
        $this->linha("\033[0;31m✗  {$texto}\033[0m");
    }

    protected function info(string $texto): void
    {
        $this->linha("\033[0;32m➜  {$texto}\033[0m");
    }

    protected function alerta(string $texto): void
    {
        $this->linha("\033[0;33m{$texto}\033[0m");
    }

    private function imprimir(string $texto): void
    {
        $fp = fopen('php://output', 'w');
        fwrite($fp, $texto); // @phpstan-ignore-line
        fclose($fp); // @phpstan-ignore-line
    }
}
