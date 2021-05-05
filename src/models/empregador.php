<?php

class Empregador {
    public $id;
    public $email;
    public $senha;
    public $nomeDoResponsavel;
    public $nomeDaEmpresa;
    public $descricao;
    public $produtos;

    public function __construct($id, $email, $senha, $nomeDoResponsavel, $nomeDaEmpresa, $descricao, $produtos) {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
        $this->nomeDoResponsavel = $nomeDoResponsavel;
        $this->nomeDaEmpresa = $nomeDaEmpresa;
        $this->descricao = $descricao;
        $this->produtos = $produtos;
    }
}

?>