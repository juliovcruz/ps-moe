<?php

  class Usuario {
    public $id;
    public $email;
    public $senha;
    public $tipo;

    public function __construct($id, $email, $senha, $tipo) {
      $this->id = $id;
      $this->email = $email;
      $this->senha = $senha;
      $this->tipo = $tipo;
    }
  }

?>