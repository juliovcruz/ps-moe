<?php

class Empregador {
  public $nomeDoResponsavel;
  public $nomeDaEmpresa;
  public $descricao;
  public $produtos;
  public $usuarioID;

  public function __construct($id, $email, $senha, $nomeDoResponsavel, $nomeDaEmpresa, $descricao, $produtos, $usuarioID) {
    $this->id = $id;
    $this->email = $email;
    $this->senha = $senha;
    $this->nomeDoResponsavel = $nomeDoResponsavel;
    $this->nomeDaEmpresa = $nomeDaEmpresa;
    $this->descricao = $descricao;
    $this->produtos = $produtos;
    $this->usuarioID = $usuarioID;
  }
}

?>