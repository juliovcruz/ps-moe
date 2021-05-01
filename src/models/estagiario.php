<?php

include_once '../models/estagiario.php';

class Estagiario extends Usuario {
  public $nome;
  public $curso;
  public $anoDeIngresso;
  public $miniCurriculo;
  public $usuarioID;

  public function __construct($id, $email, $senha, $nome, $curso, $anoDeIngresso, $miniCurriculo, $usuarioID) {
    $this->id = $id;
    $this->email = $email;
    $this->nome = $nome;
    $this->senha = $senha;
    $this->curso = $curso;
    $this->anoDeIngresso = $anoDeIngresso;
    $this->miniCurriculo = $miniCurriculo;
    $this->usuarioID = $usuarioID;
  }

}

?>