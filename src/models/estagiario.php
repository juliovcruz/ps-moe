<?php

class Estagiario {
    public $email;
    public $senha;
    public $nome;
    public $curso;
    public $anoDeIngresso;
    public $miniCurriculo;

    public function __construct($id, $email, $senha, $nome, $curso, $anoDeIngresso, $miniCurriculo) {
        $this->id = $id;
        $this->email = $email;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->curso = $curso;
        $this->anoDeIngresso = $anoDeIngresso;
        $this->miniCurriculo = $miniCurriculo;
    }

}

?>